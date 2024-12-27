<?php

function getVer( $filePath = '0' ) {
    //File modified unix datetime
    return date( "d.m.Y.H.i.s", filemtime( $filePath ) );
}

function getSvgSpriteUrl() {
  return "/wp-content/themes/bov/img/svg-sprite.svg?" . getVer('wp-content/themes/bov/img/svg-sprite.svg');
}

function cleanPhone( $phone ) {
  $phoneCleaned = strip_tags( $phone );
  $phoneCleaned = str_replace( [ ' ', '-', ')', '(' ], '',
    $phoneCleaned );

  return $phoneCleaned;
}


function var_out( $var ) {
  echo '<pre style="color: red;">';
  var_dump( $var );
  echo '</pre>';
}

//Get count days between to dates
function getCountDays( $date1, $date2 ) {
  $date1    = date_create( $date1 );
  $date2    = date_create( $date2 );
  $interval = date_diff( $date2, $date1 );

  return $interval->days + 1;
}


//Convet "capitalize" to "normal"
function convertCapitalizeCaseToNormal( $string ) {
  $lowerCased = mb_convert_case( $string, MB_CASE_LOWER );
  $normalized = my_mb_ucfirst( $lowerCased );

  return $normalized;
}

//Multibyte ucfirst
function my_mb_ucfirst( $str ) {
  $fc = mb_strtoupper( mb_substr( $str, 0, 1 ) );

  return $fc . mb_substr( $str, 1 );
}

//Multibyte substring
function cutString( $text, $letterCount ) {
  $text = htmlspecialchars( strip_tags( $text ) );

  return mb_strlen( $text, 'utf-8' ) > $letterCount ?
    mb_substr( $text, 0, $letterCount, 'utf-8' ) . '...' :
    $text;
}


/**
 * Get BEM "block" name from "element"
 * For example menu__item -> menu
 *
 * @param string $elementClass BEM element name
 *
 * @return string BEM block name
 */
function getBEMBlockName( $elementClass ) {
  preg_match_all( '/(.+)__/', $elementClass, $matches );
  if ( isset( $matches[1][0] ) ) {
    $blockClass = $matches[1][0];
  } else {
    $blockClass = 'invalid block name';
  }

  return $blockClass;
}
