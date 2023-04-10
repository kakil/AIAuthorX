"use strict";

/* Aside: submenus toggle */
$('.menu.is-menu-main .has-dropdown-icon').on('click', function () {
  var dropdownIcon = $(this).find('.dropdown-icon .mdi');
  $(this).parent().toggleClass('is-active');
  dropdownIcon.toggleClass('mdi-plus mdi-minus');
});

/* Aside Mobile toggle */
$('.jb-aside-mobile-toggle').on('click', function () {
  var dropdownIcon = $(this).find('.icon .mdi');
  $('html').toggleClass('has-aside-mobile-expanded');
  dropdownIcon.toggleClass('mdi-forwardburger mdi-backburger');
});

/* NavBar menu mobile toggle */
$('.jb-navbar-menu-toggle').on('click', function () {
  var dropdownIcon = $(this).find('.icon .mdi');
  $('#' + $(this).data('target')).toggleClass('is-active');
  dropdownIcon.toggleClass('mdi-dots-vertical mdi-close');
});

/* Modal: open */
$('.jb-modal').on('click', function () {
  var modalTarget = $(this).data('target');

  if (modalTarget === 'api-key-modal') {
    var apiKeyStorage = $('#apikeystorage');
    var apiKeyStorageModal = $('#apikeystorage-modal');
    apiKeyStorageModal.val(apiKeyStorage.val());
  }

  // Add this line to show the modal
  $('#' + modalTarget).addClass('is-active');
  $('html').addClass('is-clipped');
});

/* Modal: close */
$('.jb-modal-close').on('click', function () {
  $(this).closest('.modal').removeClass('is-active');
  $('html').removeClass('is-clipped');

  var loaderWrapper = $('.loader');
  loaderWrapper.removeClass('is-loading');
});

/* Notification dismiss */
$('.jb-notification-dismiss').on('click', function () {
  $(this).closest('.notification').addClass('is-hidden');
});

// Save button click event
$('#savekeybutton').on('click', function () {
  var apiKeyStorage = $('#apikeystorage');
  var apiKeyStorageModal = $('#apikeystorage-modal');
  apiKeyStorage.val(apiKeyStorageModal.val());

  // You can now use apiKeyStorage.val() to save the value to the backend if needed.

  // Close the modal
  var modal = $('#api-key-modal');
  modal.removeClass('is-active');
  $('html').removeClass('is-clipped');
});
