<?php
/**
 * Build a consumer-installable Marcia ZIP from validated runtime files.
 *
 * @package Marcia
 */

declare( strict_types=1 );

$root = dirname( __DIR__ );

passthru( escapeshellarg( PHP_BINARY ) . ' ' . escapeshellarg( $root . '/tools/validate-theme.php' ), $status );
if ( 0 !== $status ) {
	exit( $status );
}

if ( ! class_exists( 'ZipArchive' ) ) {
	fwrite( STDERR, "ZipArchive extension is required.\n" );
	exit( 1 );
}

$style = (string) file_get_contents( $root . '/style.css' );
if ( ! preg_match( '/^Version:\s*(.+)$/mi', $style, $match ) ) {
	fwrite( STDERR, "Unable to determine theme version.\n" );
	exit( 1 );
}

$version  = trim( $match[1] );
$dist_dir = $root . '/dist';
if ( ! is_dir( $dist_dir ) && ! mkdir( $dist_dir, 0775, true ) && ! is_dir( $dist_dir ) ) {
	fwrite( STDERR, "Unable to create dist directory.\n" );
	exit( 1 );
}

$zip_path = $dist_dir . '/marcia-' . $version . '.zip';
$zip      = new ZipArchive();
if ( true !== $zip->open( $zip_path, ZipArchive::CREATE | ZipArchive::OVERWRITE ) ) {
	fwrite( STDERR, "Unable to create release archive.\n" );
	exit( 1 );
}

$root_files = array( 'style.css', 'functions.php', 'theme.json', 'README.txt' );
if ( is_file( $root . '/screenshot.png' ) ) {
	$root_files[] = 'screenshot.png';
}

foreach ( $root_files as $file ) {
	$zip->addFile( $root . '/' . $file, 'marcia/' . $file );
}

$runtime_dirs = array( 'assets', 'inc', 'languages', 'parts', 'patterns', 'styles', 'templates' );
foreach ( $runtime_dirs as $dir ) {
	$path = $root . '/' . $dir;
	if ( ! is_dir( $path ) ) {
		continue;
	}

	$iterator = new RecursiveIteratorIterator(
		new RecursiveDirectoryIterator( $path, FilesystemIterator::SKIP_DOTS ),
		RecursiveIteratorIterator::LEAVES_ONLY
	);

	foreach ( $iterator as $file_info ) {
		if ( ! $file_info->isFile() ) {
			continue;
		}
		$relative = substr( $file_info->getPathname(), strlen( $root ) + 1 );
		$zip->addFile( $file_info->getPathname(), 'marcia/' . $relative );
	}
}

$zip->close();
fwrite( STDOUT, $zip_path . PHP_EOL );
