<?php
/*
 
2013 Florian Schmitt (use of attach, rewriting for bootstrap)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA

*/


// Get the action's parameters :

// image's filename
$list = $this->GetActionsList();
sort($list);
$formattedlistaction = '';
foreach ($list as $i => $action) {
	$formattedlistaction .= '====='.($i+1).' ""&#123;&#123;'.$action.' ...&#125;&#125;""====='."\n";
	if ($action != 'allactions' && $action != 'allhandlers' && $action != 'header' && $action != 'footer' && $action != 'toc' && $action != 'linkjavascript' && $action != 'linkstyle' && $action != 'linkrss' && $action != 'liensjavascripts' && $action != 'liensstyle') {
		$formattedlistaction .= "{{".$action."}}\n\n";
	}
	$formattedlistaction .= '------';
}

echo $this->Format($formattedlistaction);
