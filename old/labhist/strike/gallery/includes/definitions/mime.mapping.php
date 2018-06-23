<?php
/**
 * This file contains a mapping of common file extensions to
 * MIME types.
 * Any unknown file extensions will automatically be mapped to
 * 'x-extension/<ext>' where <ext> is the unknown file extension.
 *
 * @package Gallery
 *
 * $Id: mime.mapping.php 17206 2007-11-26 00:55:56Z JensT $
 */

$mime_extension_map = array(
	'arj'	=> 'application/x-arj',
	'asc'	=> 'text/plain',
	'avi'	=> 'video/x-msvideo',
	'bak'	=> 'application/x-trash',
	'bin'	=> 'application/octet-stream',
	'bmp'	=> 'image/bmp',
	'bz'	=> 'application/x-bzip',
	'bz2'	=> 'application/x-bzip',
	'csh'	=> 'application/x-shellscript',
	'css'	=> 'text/css',
	'cssl'	=> 'text/css',
	'csv'	=> 'text/x-comma-separated-values',
	'diff'	=> 'text/x-patch',
	'doc'	=> 'application/vnd.ms-word',
	'dtd'	=> 'text/x-dtd',
	'exe'	=> 'application/x-ms-dos-executable',
	'gif'	=> 'image/gif',
	'gtar'	=> 'application/x-gtar',
	'gz'	=> 'application/x-gzip',
	'htm'	=> 'text/html',
	'html'	=> 'text/html',
	'ics'	=> 'text/calendar',
	'ico'	=> 'image/x-ico',
	'iff'	=> 'image/x-iff',
	'iso'	=> 'application/x-cd-image',
	'jar'	=> 'application/x-jar',
	'jng'	=> 'image/x-jng',
	'jp2'	=> 'image/jpeg2000',
	'jpg'	=> 'image/jpeg',
	'jpe'	=> 'image/jpeg',
	'jpeg'	=> 'image/jpeg',
	'lha'	=> 'application/x-lha',
	'lhz'	=> 'application/x-lhz',
	'log'	=> 'text/x-log',
	'lzh'	=> 'application/x-lha',
	'lzo'	=> 'application/x-lzop',
	'moov'		=> 'video/quicktime',
	'mov'	=> 'video/quicktime',
	'movie'		 => 'video/x-sgi-movie',
	'mp2'	=> 'video/mpeg',
	'mp3'	=> 'audio/x-mp3',
	'mpe'	=> 'video/mpeg',
	'mpeg'		=> 'video/mpeg',
	'mpg'	=> 'video/mpeg',
	'mpga'		=> 'audio/mpeg',
	'nsv'	=> 'video/x-nsv',
	'ogg'	=> 'application/ogg',
	'pdf'	=> 'application/pdf',
	'pem'	=> 'application/x-x509-ca-cert',
	'perl'	=> 'application/x-perl',
	'pgp'	=> 'application/pgp',
	'php'	=> 'application/x-php',
	'php3'	=> 'application/x-php',
	'php4'	=> 'application/x-php',
	'pict'	=> 'image/x-pict',
	'pict1'	=> 'image/x-pict',
	'pict2'	=> 'image/x-pict',
	'pl'	=> 'application/x-perl',
	'pm'	=> 'application/x-perl',
	'png'	=> 'image/png',
	'po'	=> 'text/x-gettext-translation',
	'pot'	=> 'text/x-gettext-translation-template',
	'ppm'	=> 'image/x-portable-pixmap',
	'pps'	=> 'application/vnd.ms-powerpoint',
	'ppt'	=> 'application/vnd.ms-powerpoint',
	'ppz'	=> 'application/vnd.ms-powerpoint',
	'ps'	=> 'application/postscript',
	'ps.gz'	=> 'application/x-gzpostscript',
	'psd'	=> 'image/x-psd',
	'qt'	=> 'video/quicktime',
	'qtvr'	=> 'video/quicktime',
	'ra'	=> 'audio/x-pn-realaudio',
	'ram'	=> 'audio/x-pn-realaudio',
	'rar'	=> 'application/x-rar',
	'rm'	=> 'audio/x-pn-realaudio',
	'rpm'	=> 'application/x-rpm',
	'rss'	=> 'text/rss',
	'rtf'	=> 'application/rtf',
	'rtx'	=> 'text/richtext',
	'scm'	=> 'text/x-scheme',
	'sgm'	=> 'text/sgml',
	'sgml'	=> 'text/sgml',
	'sh'	=> 'application/x-shellscript',
	'shtml'	=> 'text/html',
	'sql'	=> 'text/x-sql',
	'sty'	=> 'text/x-tex',
	'svg'	=> 'image/svg+xml',
	'swf'	=> 'application/x-shockwave-flash',
	't'		=> 'application/x-troff',
	'tar'	=> 'application/x-tar',
	'tar.Z'	=> 'application/x-tarz',
	'tar.bz'	=> 'application/x-bzip-compressed-tar',
	'tar.bz2'	=> 'application/x-bzip-compressed-tar',
	'tar.gz'	=> 'application/x-compressed-tar',
	'tar.lzo'	=> 'application/x-tzo',
	'tcl'	=> 'text/x-tcl',
	'tex'	=> 'text/x-tex',
	'texi'	=> 'text/x-texinfo',
	'texinfo'	=> 'text/x-texinfo',
	'tgz'	=> 'application/x-compressed-tar',
	'theme'	=> 'application/x-theme',
	'tif'	=> 'image/tiff',
	'tiff'	=> 'image/tiff',
	'tk'	=> 'text/x-tcl',
	'torrent'	=> 'application/x-bittorrent',
	'ttf'	=> 'application/x-font-ttf',
	'txt'	=> 'text/plain',
	'uri'	=> 'text/x-uri',
	'url'	=> 'text/x-uri',
	'vcf'	=> 'text/x-vcalendar',
	'vcs'	=> 'text/x-vcalendar',
	'vct'	=> 'text/x-vcard',
	'vfb'	=> 'text/calendar',
	'vob'	=> 'video/mpeg',
	'wav'	=> 'audio/x-wav',
	'wmf'	=> 'image/x-wmf',
	'wml'	=> 'text/vnd.wap.wml',
	'xla'	=> 'application/vnd.ms-excel',
	'xlc'	=> 'application/vnd.ms-excel',
	'xld'	=> 'application/vnd.ms-excel',
	'xll'	=> 'application/vnd.ms-excel',
	'xlm'	=> 'application/vnd.ms-excel',
	'xls'	=> 'application/vnd.ms-excel',
	'xlt'	=> 'application/vnd.ms-excel',
	'xlw'	=> 'application/vnd.ms-excel',
	'xm'	=> 'audio/x-mod',
	'xmi'	=> 'text/x-xmi',
	'xml'	=> 'text/xml',
	'xul'	=> 'application/vnd.mozilla.xul+xml',
	'z'		=> 'application/x-compress',
	'zip'	=> 'application/zip',
	'zoo'	=> 'application/x-zoo',
);