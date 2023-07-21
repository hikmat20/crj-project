<?php defined('BASEPATH') or exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Parser Enabled
|--------------------------------------------------------------------------
|
| Should the Parser library be used for the entire page?
|
| Can be overridden with $this->template->enable_parser(TRUE/FALSE);
|
|   Default: TRUE
|
*/

$config['parser_enabled'] = FALSE;

/*
|--------------------------------------------------------------------------
| Parser Enabled for Body
|--------------------------------------------------------------------------
|
| If the parser is enabled, do you want it to parse the body or not?
|
| Can be overridden with $this->template->enable_parser(TRUE/FALSE);
|
|   Default: FALSE
|
*/

$config['parser_body_enabled'] = FALSE;

/*
|--------------------------------------------------------------------------
| Title Separator
|--------------------------------------------------------------------------
|
| What string should be used to separate title segments sent via $this->template->title('Foo', 'Bar');
|
|   Default: ' | '
|
*/

$config['title_separator'] = ' | ';

/*
|--------------------------------------------------------------------------
| Layout
|--------------------------------------------------------------------------
|
| Which layout file should be used? When combined with theme it will be a layout file in that theme
|
| Change to 'main' to get /application/views/layouts/main.php
|
|   Default: 'default'
|
*/

$config['layout'] = 'default';

/*
|--------------------------------------------------------------------------
| Theme
|--------------------------------------------------------------------------
|
| Which theme to use by default?
|
| Can be overriden with $this->template->set_theme('foo');
|
|   Default: ''
|
*/

$config['theme'] = '';

/*
|--------------------------------------------------------------------------
| Theme Locations
|--------------------------------------------------------------------------
|
| Where should we expect to see themes?
|
|	Default: array(APPPATH.'themes/' => '../themes/')
|
*/

//------------------------------------------------------------------------------
// MESSAGE TEMPLATE
//------------------------------------------------------------------------------
// This is the template that the Template library will use when displaying
// messages through the message() function.
// To set the class for the type of message (error, success, etc), the {type}
// placeholder will be replaced. The message will replace the {message}
// placeholder.
// <div class="alert alert-{type} alert-dismissable">
//    <i class="{icon}"></i>
//    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
//    <b>
//        {title}
//    </b>
//    <br>{message}
// </div>
// <div class="alert alert-solid alert-{type}" role="alert">
//   <button type="button" class="close btn-icon btn-default btn-xs wd-20" data-dismiss="alert" aria-label="Close">
//     <span aria-hidden="true">&times;</span>
//   </button>
//   <div class="d-flex align-items-center justify-content-start">
//     <i class="{icon} alert-icon tx-32 mg-t-5 mg-xs-t-0"></i>
//     <span><strong>{title}!</strong>&nbsp;{message}</span>
//   </div>
// </div>

$config['template.message_template'] = <<<EOD
<div class="alert alert-bordered alert-{type}" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
  <div class="d-flex align-items-center justify-content-start">
    <i class="{icon} alert-icon tx-32 mg-t-5 mg-xs-t-0"></i>
    <span>{message}</span>
  </div>
</div>
EOD;

$config['theme_locations'] = array(
  'themes/'
);
