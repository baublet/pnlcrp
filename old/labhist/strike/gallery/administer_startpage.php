<?php
/*
 * Gallery - a web based photo album viewer and editor
 * Copyright (C) 2000-2008 Bharat Mediratta
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or (at
 * your option) any later version.
 *
 * This program is distributed in the hope that it will be useful, but
 * WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street - Fifth Floor, Boston, MA  02110-1301, USA.
 *
 * $Id: administer_startpage.php 18730 2008-11-17 23:03:22Z JensT $
 *
 */

if (!isset($gallery->version)) {
        require_once(dirname(__FILE__) . '/init.php');
}

if (!$gallery->user->isAdmin()) {
        echo gTranslate('core', "You are not allowed to perform this action!");
        includeHtmlWrap("popup.footer");
        exit;
}

list($sort, $order, $fieldname) = getRequestVar(array('sort', 'order', 'fieldname'));

$adminOptions[] = array(
    'text' => gTranslate('core', "Rebuild highlights"),
    'url' =>  doCommand('rebuild_highlights'),
    'longtext' => gTranslate('core', "Recreate all highlights according to the setting in Config Wizard.<br>(Starts immediately)")
);

$adminOptions[] = array(
    'text' => gTranslate('core', "Album Order"),
    'url' => makeGalleryUrl('administer_startpage.php', array('sort' => 1, 'type' => 'popup')),
    'longtext' => gTranslate('core', "Sort the albums on the startpage(s).<br>(Opens an option dialog)")
);

array_sort_by_fields($adminOptions, 'text', 'asc');

$sortOptions = array(
    'name'          => gTranslate('core', "By (physical) name."),
    'clicks_date'   => gTranslate('core', "By last reset date."),
    'creation_date' => gTranslate('core', "By creation date (works only with albums created with 1.5.2 or newer).")
);

printPopupStart(gTranslate('core', "Administer startpage"), '', 'left');

if(empty($sort)) {
    echo "\n<table width=\"100%\">";
    foreach ($adminOptions as $option) {
	echo "\n<tr>";
	if (isset($option['url'])) {
		$link = '<a class="admin" href="'. $option['url'] .'">'. $option['text'] .'</a>';
	} else {
		$link = popup_link($option['text'], $option['popupFile'], false, true, 500, 500, 'admin');
	}
	echo "\n<td class=\"adm_options\">$link</td>";
	echo "\n<td class=\"adm_options\">". $option['longtext'] ."</td>";
	echo "\n</tr>";
    }
    echo "\n</table>";
}
elseif (empty($order)) {
	echo makeFormIntro('administer_startpage.php', array(), array('type' => 'popup'));
?>
<table>
<caption><?php echo gTranslate('core', "Sort albums on startpage"); ?></caption>
<?php
    foreach ($sortOptions as $sortBy => $text) {
        echo "\n <tr>";
        echo "\n  <td><input checked type=\"radio\" name=\"fieldname\" value=\"$sortBy\"></td>";
        echo "\n  <td>$text</td>";
        echo "\n </tr>";
    }
?>
</table>
<p>
<?php echo gTranslate('core', "Sort Order:"); ?>
    <select name="order">
        <option value="asc"><?php echo gTranslate('core', "Ascending") ?></option>
        <option value="desc"><?php echo gTranslate('core', "Descending") ?></option>
    </select>
</p>

<input type="hidden" name="sort" value="1">
<?php echo gSubmit('confirm', gTranslate('core', "Sort")); ?>
<?php echo gButton('cancel', gTranslate('core', "Close Window"),'parent.close()'); ?>
</form>
<?php
}
else {
    /* Read the album list */
    $albumDB = new AlbumDB(FALSE);
    $albumDB->sortByField($fieldname, $order);
    dismissAndReload();

    echo gButton('cancel', gTranslate('core', "Close Window"),'parent.close()');
}

includeHtmlWrap("popup.footer");

?>

</body>
</html>
