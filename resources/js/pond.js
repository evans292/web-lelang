require('./bootstrap');
require('alpinejs');

import $ from "jquery";
import { select2 } from "select2";
import * as Popper from '@popperjs/core';
import Swal from "sweetalert2";

import Vue from "vue";
import VueToast from 'vue-toast-notification';
import 'vue-toast-notification/dist/theme-sugar.css'

import * as FilePond from "filepond";

import FilePondPluginFileValidateType from 'filepond-plugin-file-validate-type';
import FilePondPluginImageExifOrientation from 'filepond-plugin-image-exif-orientation';
import FilePondPluginImagePreview from 'filepond-plugin-image-preview';
import FilePondPluginImageCrop from "filepond-plugin-image-crop";
import FilePondPluginImageResize from "filepond-plugin-image-resize";
import FilePondPluginImageTransform from "filepond-plugin-image-transform";
import FilePondPluginImageEdit from "filepond-plugin-image-edit";
import FilePondPluginFileValidateSize from 'filepond-plugin-file-validate-size';

import "filepond/dist/filepond.min.css";
import 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css';
import "filepond-plugin-image-edit/dist/filepond-plugin-image-edit.css";

// ============= FILEPOND =====================================

FilePond.registerPlugin(
    FilePondPluginFileValidateType,
    FilePondPluginFileValidateSize,
    FilePondPluginImageExifOrientation,
    FilePondPluginImagePreview,
    FilePondPluginImageCrop,
    FilePondPluginImageResize,
    FilePondPluginImageTransform,
    FilePondPluginImageEdit
);

const ponds = FilePond.create(document.querySelector('input[id="pics"]'), {
    labelIdle: `Seret foto barang atau <span class="filepond--label-action">Telusuri</span>`,
    allowMultiple: true,
});

FilePond.setOptions({
    server: {
        url: '/upload-multiple',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        }
    }
});



// ============= SWAL 2 =====================================

window.deleteConfirm = function(title, formId)
{
    Swal.fire({
        icon: 'warning',
        text: `Hapus data ini (${title}) ?`,
        showCancelButton: true,
        confirmButtonText: 'Hapus',
        cancelButtonText: 'Batal',
        confirmButtonColor: '#e3342f',
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById(formId).submit();
        }
    });
}

window.winnerConfirm = function(title, formId)
{
    Swal.fire({
        icon: 'question',
        text: `Pilih ${title} sebagai pemenang ?`,
        showCancelButton: true,
        confirmButtonText: 'Pilih',
        cancelButtonText: 'Batal',
        confirmButtonColor: '#34d399',
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById(formId).submit();
        }
    });
}

// ============= VUE =====================================

Vue.use(VueToast);

window.greet = function(args, position = 'top') 
{
    Vue.$toast.success(`Halo ${args}!`, {
        duration: 1500,
        dismissible: true,
        position: position
       })    
}

window.success = function(args) 
{
    Vue.$toast.success(`${args}`, {
        duration: 2000,
        dismissible: true,
        position: 'top-right'
       })    
}

// ============= POPPER =====================================

/* Sidebar - Side navigation menu on mobile/responsive mode */
window.toggleNavbar  = function (collapseID) {
document.getElementById(collapseID).classList.toggle("hidden");
document.getElementById(collapseID).classList.toggle("bg-white");
document.getElementById(collapseID).classList.toggle("m-2");
document.getElementById(collapseID).classList.toggle("py-3");
document.getElementById(collapseID).classList.toggle("px-6");
}

/* Function for dropdowns */
window.openDropdown = function (event, dropdownID) {
let element = event.target;
while (element.nodeName !== "A") {
    element = element.parentNode;
}
Popper.createPopper(element, document.getElementById(dropdownID), {
    placement: "bottom-start",
});
document.getElementById(dropdownID).classList.toggle("hidden");
document.getElementById(dropdownID).classList.toggle("block");
}

// ============= SELECT 2 =====================================

$('.select2').select2({
    placeholder: 'Pilih sebuah opsi'
});