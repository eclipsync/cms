<?php
/**
 * Created on Feb 23, 2023
 * 
 * Time Created : 4:41:21 PM
 *
 * @filesource  settings.php
 *
 * @author      Hamid Samak, wisnuwidi@gmail.com - 2023
 * @copyright   Hamid Samak, wisnuwidi@gmail.com,
 *              incodiy@gmail.com
 * @email       wisnuwidi@gmail.com
 */
$appName            = 'Eclipsync';
$faultAttempt       = 3;
$useInFocus         = false;
$nodeString         = strtolower($appName);
$anchorTitle        = "Eclipsync Hidden Project";
$imgBasePath        = 'config/img/';
$logName            = ".{$nodeString}log";
$historyName        = ".{$nodeString}history";

$realPath           = realpath(__DIR__);
$realPathDir        = str_replace('/public/eclipsync/config', '', str_replace('\public\eclipsync\config', '', $realPath));

$imagePath          = $realPath . '/img';
$scanDir            = scandir($imagePath, SCANDIR_SORT_DESCENDING);
$imgRand            = array_rand($scanDir);
$backgroundImages   = $imgBasePath . '1.webp';
$background         = null;
if ('.' == $scanDir[$imgRand] || '..' == $scanDir[$imgRand]) {
    $backgroundImages = $imgBasePath . '1.webp';
} else {
    $backgroundImages = $imgBasePath . $scanDir[$imgRand];
}
if (!empty($backgroundImages)) {
    $background       = ' style="background-image: url(\'' . $backgroundImages . '\')"';
} else {
    $background       = ' style="background-image: url(\'' . $imgBasePath . 'config/img/1.webp\')"';
}
$faviconImage       = "data:image/x-icon;base64,R0lGODlhEAAQAPYAAAAAAACaSgSdTwacTgWdUAadUAeeUQidUA2gVQ6hVhOiWBOiWRikXRmlXRulXx2mYCSpZTCtbTSvcTawcTixczyydkS2fEy4gE25gk65g1S8h1i9ilm+ilq+i2LBkWTCkmfDlG3FmG3GmW7GmW/GmW/GmnDGmnDHmnDHm3HHmnHHm3LHnHLInHPInXbJnnjJn4rRrY3Sr47Sr47SsI/TsJHUspLUspLUs5PUs5TUs5bWtZfWtpjWt5nXt5vXuJvXuZzYuZ3YuqDZvKLavajcwandwq3exa7fxrDfx7DgyLHgyLLgybPhybPhyrThyrXhy7fizLfmzrjjzb3l0L7l0b/m0sDi0cLj0sDm0sXo1sjp2Mnp2crq2szq28zr283r283r3NTu4dfu4tjv49nw5Nny5drw5dzx5t3x5+Lz6+Pz6+X07OX07eb17eb17uv38e748/T79/b7+Pb7+ff7+fzy+P/y+//z//v9/Pz+/f3+/f3+/v7+/v/+/v///wAAACH5BAlQAH8AIf8LTkVUU0NBUEUyLjADAQAAACwAAAAAEAAQAAAH/oB/f39/fn5+fn5+fn5/f39/f39/fn5raExMYmp+fn9/f39/fnFfNCkrKyM0XXF+fn9/fnQ8IyM3R0w6IyM6cX5/f35gIzhBRHB+eFU3KVp+f35rNCNBGVlhVW9QRCs0aX5+ZCk3HxgfFBIePzQ/KWJ+fkwrQREYFg0LFR0vUCtIfvwwcRFEQoMFAQIccEBEygokfvygSWHDxYAEBAg82CAlSAoxfvyssRHiiAUCBBJAGFFlhIw0fv746TLCBhMYGjb8qHIjxRY/f/74icOjxIggUKAEWTFCRxw/f/788UPnC40RK1aMkJEljh8/f/78+eMHz5oxTJiQWePHz58/FX/+/Pnzx48fP3j8+PHj58+fP38CAQAh+QQJCgABACwAAAAAEAAQAIAAAAAAAAAC50wSEREREUIIIYQQQgghhBAEQRAEQRAEQRAEQRAEQRAEQRAEQRAEQRAIBAKBQCAQCAQCgUAgEAgEAoFAIBAIBAKBQCAQCAQCgUAgEAgEAoFAIBAIBAKBQCAQCAQCgUAgEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQIECAAAEKAAA7";$infoURL            = explode('::', '#THIS CODE CREATED BY INCODIY|ECLIPSYNC|W20::');

$keyboard_shortcuts = [
    ['New File',                               ['Ctrl', 'Alt / &#8997;', 'N']],
    ['Save File',                              ['Ctrl', 'Alt / &#8997;', 'S']],
    ['Find',                                   ['Ctrl / &#8984;', 'F']],
    ['Find next',                              ['Ctrl / &#8984;', 'G']],
    ['Find previous',                          ['Ctrl / &#8984;', 'Shift', 'G']],
    ['Replace',                                ['Ctrl / &#8984;', 'Shift', 'F']],
    ['Replace all',                            ['Ctrl / &#8984;', 'Shift', 'R']],
    ['Persistent search',                      ['Alt / &#8997;', 'F']],
    ['Go to line',                             ['Alt / &#8997;', 'G']],
    ['Toggle Terminal',                        ['Ctrl', 'Alt / &#8997;', 'L']],
    ['Terminal history',                       ['Up', 'Down']],
    ['Open file menu',                         ['Esc (x2)']],
    ['Switch between file manager and editor', ['Esc']],
];
//$background         = '';

$DEFINERS                            = [];
$DEFINERS['VERSION']                 = '2.0.1';
$DEFINERS['LOG_FILE']                = $logName;
$DEFINERS['SHOW_PHP_SELF']           = false;
$DEFINERS['SHOW_HIDDEN_FILES']       = false;
$DEFINERS['ACCESS_IP']               = '';
$DEFINERS['HISTORY_PATH']            = $historyName;
$DEFINERS['MAX_HISTORY_FILES']       = 5;
$DEFINERS['WORD_WRAP']               = true;
$DEFINERS['PERMISSIONS']             = 'newfile,newdir,editfile,deletefile,deletedir,renamefile,renamedir,changepassword,uploadfile,terminal';
$DEFINERS['PATTERN_FILES']           = '/^[A-Za-z0-9-_.\/]*\.(txt|php|htm|html|js|css|tpl|md|xml|json)$/i';
$DEFINERS['PATTERN_DIRECTORIES']     = '/^((?!backup).)*$/i';
$DEFINERS['TERMINAL_COMMANDS']       = './composer.phar,sudo,vi,vim,ls,ll,cp,rm,mv,whoami,pidof,pwd,whereis,kill,php,date,cd,mkdir,chmod,chown,rmdir,touch,cat,git,find,grep,echo,tar,zip,unzip,whatis,df,help,locate,pkill,du,updatedb,composer,exit';
$DEFINERS['EDITOR_THEME']            = 'monokai';
$DEFINERS['DEFAULT_DIR_PERMISSION']  = 0755;
$DEFINERS['DEFAULT_FILE_PERMISSION'] = 0644;
$DEFINERS['LOCAL_ASSETS']            = true;

define('MAIN_DIR',                     $realPathDir);
define('DS',                           DIRECTORY_SEPARATOR);

define('VERSION',                      $DEFINERS['VERSION']);
define('LOG_FILE', MAIN_DIR . DS .     $DEFINERS['LOG_FILE']);
define('SHOW_PHP_SELF',                $DEFINERS['SHOW_PHP_SELF']);
define('SHOW_HIDDEN_FILES',            $DEFINERS['SHOW_HIDDEN_FILES']);
define('ACCESS_IP',                    $DEFINERS['ACCESS_IP']);
define('HISTORY_PATH', MAIN_DIR . DS . $DEFINERS['HISTORY_PATH']);
define('MAX_HISTORY_FILES',            $DEFINERS['MAX_HISTORY_FILES']);
define('WORD_WRAP',                    $DEFINERS['WORD_WRAP']);
define('PERMISSIONS',                  $DEFINERS['PERMISSIONS']); // empty means all
define('PATTERN_FILES',                $DEFINERS['PATTERN_FILES']); // empty means no pattern
define('PATTERN_DIRECTORIES',          $DEFINERS['PATTERN_DIRECTORIES']); // empty means no pattern
define('TERMINAL_COMMANDS',            $DEFINERS['TERMINAL_COMMANDS']);
define('EDITOR_THEME',                 $DEFINERS['EDITOR_THEME']); // e.g. monokai
define('DEFAULT_DIR_PERMISSION',       $DEFINERS['DEFAULT_DIR_PERMISSION']);
define('DEFAULT_FILE_PERMISSION',      $DEFINERS['DEFAULT_FILE_PERMISSION']);
define('LOCAL_ASSETS',                 $DEFINERS['LOCAL_ASSETS']); // if true you should run `npm i` to download required libraries

$assets = [
	'cdn' => [
		'css' => [
			'https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css',
			'https://cdnjs.cloudflare.com/ajax/libs/jstree/3.3.7/themes/default/style.min.css',
			'https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.43.0/codemirror.min.css',
			'https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.43.0/addon/lint/lint.min.css',
			'https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.43.0/addon/dialog/dialog.min.css',
			'https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.43.0/theme/monokai.css',
			empty(EDITOR_THEME) ? '' : 'https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.43.0/theme/' . EDITOR_THEME . '.css',
			'https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.min.css',
			'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css',
		],
		'js' => [
			'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js',
			'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js',
			'https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js',
			'https://cdnjs.cloudflare.com/ajax/libs/jstree/3.3.7/jstree.min.js',
			'https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.43.0/codemirror.min.js',
			'https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.43.0/mode/javascript/javascript.min.js',
			'https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.43.0/mode/css/css.min.js',
			'https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.43.0/mode/php/php.min.js',
			'https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.43.0/mode/xml/xml.min.js',
			'https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.43.0/mode/htmlmixed/htmlmixed.js',
			'https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.43.0/mode/markdown/markdown.js',
			'https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.43.0/mode/clike/clike.min.js',
			'https://cdnjs.cloudflare.com/ajax/libs/jshint/2.10.2/jshint.min.js',
			'https://cdnjs.cloudflare.com/ajax/libs/jsonlint/1.6.0/jsonlint.min.js',
			'https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.43.0/addon/lint/lint.min.js',
			'https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.43.0/addon/lint/javascript-lint.min.js',
			'https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.43.0/addon/lint/json-lint.min.js',
			'https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.43.0/addon/lint/css-lint.min.js',
			'https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.43.0/addon/search/search.min.js',
			'https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.43.0/addon/search/searchcursor.min.js',
			'https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.43.0/addon/search/jump-to-line.min.js',
			'https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.43.0/addon/dialog/dialog.min.js',
			'https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js',
			'https://cdnjs.cloudflare.com/ajax/libs/js-sha512/0.8.0/sha512.min.js'
		],
	],
	'local' => [
		'css' => [
			'node_modules/bootstrap/dist/css/bootstrap.min.css',
			'node_modules/jstree/dist/themes/default/style.min.css',
			'node_modules/codemirror/lib/codemirror.css',
			'node_modules/codemirror/addon/lint/lint.css',
			'node_modules/codemirror/addon/dialog/dialog.css',
			'node_modules/codemirror//theme/monokai.css',
			empty(EDITOR_THEME) ? '' : 'node_modules/codemirror/theme/' . EDITOR_THEME . '.css',
			'node_modules/izitoast/dist/css/iziToast.min.css',
			'node_modules/@fortawesome/fontawesome-free/css/all.min.css'
		],
		'js' => [
			'node_modules/jquery/dist/jquery.min.js',
			'node_modules/bootstrap/dist/js/bootstrap.bundle.min.js',
			'node_modules/jstree/dist/jstree.min.js',
			'node_modules/codemirror/lib/codemirror.js',
			'node_modules/codemirror/mode/javascript/javascript.js',
			'node_modules/codemirror/mode/css/css.js',
			'node_modules/codemirror/mode/php/php.js',
			'node_modules/codemirror/mode/xml/xml.js',
			'node_modules/codemirror/mode/htmlmixed/htmlmixed.js',
			'node_modules/codemirror/mode/markdown/markdown.js',
			'node_modules/codemirror/mode/clike/clike.js',
			'node_modules/jshint/dist/jshint.js',
		//	'node_modules/jsonlint/lib/jsonlint.js',
			'node_modules/codemirror/addon/lint/lint.js',
			'node_modules/codemirror/addon/lint/javascript-lint.js',
			'node_modules/codemirror/addon/lint/json-lint.js',
			'node_modules/codemirror/addon/lint/css-lint.js',
			'node_modules/codemirror/addon/search/search.js',
			'node_modules/codemirror/addon/search/searchcursor.js',
			'node_modules/codemirror/addon/search/jump-to-line.js',
			'node_modules/codemirror/addon/dialog/dialog.js',
			'node_modules/izitoast/dist/js/iziToast.min.js',
			'node_modules/js-sha512/build/sha512.min.js'
		],
	],
];