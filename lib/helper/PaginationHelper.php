<?php

function pager_navigation($pager, $uri, $options = array())
{
  if (!$pager->haveToPaginate())
  {
    return '';
  }
  
  $navigation = '';    
  
  use_helper('I18N');
  
  $pages_displayed = sfConfig::get('app_sfSimpleForumPlugin_pages_displayed', 5);
  
  $uri .= (preg_match('/\?/', $uri) ? '&' : '?').'page=';

  // First page
  if ($pager->getPage() > $pages_displayed + 1)
  {
    $navigation .= '<a href="'.url_for($uri.'1').'"> <li class="first symbol"> </li> </a>';
  }  
  
  // Previous page
  if ($pager->getPage() != 1)
    $navigation .= '<a href="'.url_for($uri.$pager->getPreviousPage()).'"> <li class="prev symbol"> </li> </a>';
  
  // Pages one by one
  $max_page = min($pager->getPage() + $pages_displayed, $pager->getLastPage());
  $min_page = max($pager->getPage() - $pages_displayed, 1);
  
  for ($page = $min_page; $page <= $max_page; $page++)
  {
    if($page == $pager->getPage())
    {
      $navigation .= '<a href="'.url_for($uri.$page).'"> <li class="active">'.$page.'</li> </a>';
    }
    else
    {
      $navigation .= '<a href="'.url_for($uri.$page).'"> <li>'.$page.'</li> </a>';
    }
  }
  
  // Next page
  if ($pager->getPage() != $pager->getLastPage())
    $navigation .= '<a href="'.url_for($uri.$pager->getNextPage()).'"> <li class="next symbol"> </li> </a>';
    
  // Last page
  if ($pager->getPage() < ($pager->getLastPage() - $pages_displayed))
  {
    $navigation .= '<a href="'.url_for($uri.$pager->getLastPage()).'"> <li class="last symbol"></li> </a>';
  }
  
  return '<div id="pagination"><ul>'.$navigation.'</ul></div>';
}
