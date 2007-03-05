<?php
/*
  $Id: $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2007 osCommerce

  Released under the GNU General Public License
*/

  $osC_ObjectInfo_Customer = new osC_ObjectInfo(osC_Customers_Admin::getData($_GET['cID']));
  $osC_ObjectInfo_AddressBook = new osC_ObjectInfo(osC_Customers_Admin::getAddressBookData($_GET['cID'], $_GET['abID']));
?>

<h1><?php echo osc_link_object(osc_href_link(FILENAME_DEFAULT, $osC_Template->getModule()), $osC_Template->getPageTitle()); ?></h1>

<?php
  if ( $osC_MessageStack->size($osC_Template->getModule()) > 0 ) {
    echo $osC_MessageStack->output($osC_Template->getModule());
  }
?>

<div class="infoBoxHeading"><?php echo osc_icon('trash.png', IMAGE_DELETE) . ' ' . osc_output_string_protected($osC_ObjectInfo_Customer->get('customers_firstname')) . ' ' . osc_output_string_protected($osC_ObjectInfo_Customer->get('customers_lastname')); ?></div>
<div class="infoBoxContent">
  <form name="abDelete" action="<?php echo osc_href_link_admin(FILENAME_DEFAULT, $osC_Template->getModule() . '&cID=' . $_GET['cID'] . '&search=' . $_GET['search'] . '&page=' . $_GET['page'] . '&abID=' . $osC_ObjectInfo_AddressBook->get('address_book_id') . '&action=deleteAddress'); ?>" method="post">

<?php
  if ( $osC_ObjectInfo_Customer->get('customers_default_address_id') == $osC_ObjectInfo_AddressBook->get('address_book_id') ) {
?>

  <p><?php echo '<b>' . TEXT_INFO_DELETE_ADDRESS_BOOK_PROHIBITED . '</b>'; ?></p>

  <p><?php echo osC_Address::format($osC_ObjectInfo_AddressBook->getAll(), ', '); ?></p>

  <p align="center"><?php echo '<input type="button" value="' . IMAGE_BACK . '" onclick="document.location.href=\'' . osc_href_link_admin(FILENAME_DEFAULT, $osC_Template->getModule() . '&cID=' . $_GET['cID'] . '&search=' . $_GET['search'] . '&page=' . $_GET['page'] . '&action=save&tabIndex=tabAddressBook') . '\';" class="operationButton" />'; ?></p>

<?php
  } else {
?>

  <p><?php echo TEXT_DELETE_ADDRESS_BOOK_INTRO; ?></p>

  <p><?php echo '<b>' . osC_Address::format($osC_ObjectInfo_AddressBook->getAll(), ', ') . '</b>'; ?></p>

  <p align="center"><?php echo osc_draw_hidden_field('subaction', 'confirm') . '<input type="submit" value="' . IMAGE_DELETE . '" class="operationButton" /> <input type="button" value="' . IMAGE_CANCEL . '" onclick="document.location.href=\'' . osc_href_link_admin(FILENAME_DEFAULT, $osC_Template->getModule() . '&cID=' . $_GET['cID'] . '&search=' . $_GET['search'] . '&page=' . $_GET['page'] . '&action=save&tabIndex=tabAddressBook') . '\';" class="operationButton" />'; ?></p>

<?php
  }
?>

  </form>
</div>