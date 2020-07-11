<?php

// // Flash message helper
// // EXAMPLE - flash('register_success', 'You are now registered', optional: 'alert alert-danger');
// // DISPLAY IN VIEW - echo flash('register_success');
// function flash($name = '', $message = '', $class = 'alert alert-success'){
//   if(!empty($name)){
//     if(!empty($message) && empty($_SESSION[$name])){
//       if(!empty($_SESSION[$name])){
//         unset($_SESSION[$name]);
//       }

//       if(!empty($_SESSION[$name. '_class'])){
//         unset($_SESSION[$name. '_class']);
//       }

//       $_SESSION[$name] = $message;
//       $_SESSION[$name. '_class'] = $class;
//     } elseif(empty($message) && !empty($_SESSION[$name])){
//       $class = !empty($_SESSION[$name. '_class']) ? $_SESSION[$name. '_class'] : '';
//       echo '<div class="d-flex justify-content-center"><div class="'.$class.' alert-dismissible fade show col-xl-8" role="alert" id="msg-flash">' . $_SESSION[$name] . '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div></div>';
//       unset($_SESSION[$name]);
//       unset($_SESSION[$name. '_class']);
//     }
//   }
// }

// function isLoggedIn() {
//   if(isset($_SESSION['user_id'])) {
//     return true;
//   } else {
//     return false;
//   }
// }

// function hasAccess() {
//   if($_SESSION['user_role'] == 'admin') {
//     return true;
//   } else {
//     return false;
//   }
// }

function paginationOptions($options = []) {

  if(!empty($_SESSION['pagination_options'])){
    unset($_SESSION['pagination_options']);
  }
    
  $pagination_options = [ 
    'rows_per_page' => empty($options['rows_per_page']) || (int)$options['rows_per_page'] < 1 ? 5 : $options['rows_per_page'],
    'last_page' => 0,
    'limit' => 0,
  ];

  // verify the num_rows or rows_per_page aren't 0 or negative values and so the field is not empty, in either case became true the last_page will be one
  if (empty($options['num_rows']) || (int)$options['num_rows'] < 1) {
    $pagination_options['last_page'] = 1;
  } else {
    $pagination_options['last_page'] = ceil((int)$options['num_rows']/(int)$pagination_options['rows_per_page']);
  }

  

  $_SESSION['pagination_options'] = $pagination_options;

}

function getLastPage() {
  return $_SESSION['pagination_options']['last_page'];
}

function getLimitPerPage($page) {
  $rows_per_page = $_SESSION['pagination_options']['rows_per_page'];

  return 'LIMIT ' .($page - 1) * $rows_per_page .',' . $rows_per_page;
}

// function getNumberOfPages($num_rows) {

// }