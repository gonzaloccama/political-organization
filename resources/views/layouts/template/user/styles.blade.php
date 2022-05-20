<style>
    /*button.btn, .btn, .modal-content, .iq-card {*/
    /*    border-radius: 0 !important;*/
    /*}*/

    input,
    textarea, select {
        border: 1px solid rgba(71, 71, 71, 0.32) !important;
    }

    input, textarea, label, select {
        border-radius: 5px !important;
    }

    input:focus, textarea:focus, select:focus {
        border: 1px solid var(--iq-primary) !important;
        box-shadow: rgba(1, 71, 212, 0.32) 0px 0px 5px 0px !important;
    }

    .media-comment {
        padding: 0.6rem 10rem 0.6rem 0.8rem;
        line-height: 180%
    }

    .media-comment {
        resize: vertical;
        overflow: hidden;
    }

    .media-comment,
    .media-comment::after {
        padding: 0.6rem 10rem 0.6rem 0.8rem;
        line-height: 180%;
    }

    .media-comment:focus {
        box-shadow: rgba(13, 45, 98, 0.32) 0px 0px 5px 0px;
    }

    /*** tooltip ***/
    .tooltip-inner {
        background-color: var(--iq-primary) ;
        /*border-radius: 0;*/
        box-shadow: 0 0 5px 0 rgba(1, 71, 212, 0.70);
    }

    .bs-tooltip-auto[x-placement^=top] .arrow::before,
    .bs-tooltip-top .arrow::before {
        border-top-color: var(--iq-primary)  !important;
    }

    .bs-tooltip-top .arrow::after {
        content: "";
        position: absolute;
        bottom: 0;
        border-width: 0 .4rem .4rem;
        transform: translateY(3px);
        border-color: transparent;
        border-style: solid;
        border-top-color: var(--iq-primary) ;
    }

    .total-like-block .dropdown .dropdown-menu, .total-comment-block .dropdown .dropdown-menu {
        background-color: rgba(1, 71, 212, 0.70);
        /*border-radius: 0;*/
    }

    @media (min-width: 768px) {
        .menu-social-color {
            color: white !important;
        }

        .menu-social-color:hover {
            color: #afdbf8 !important;
        }
    }

    @media (min-width: 481px) and (max-width: 767px) {
        .menu-social-color {
            color:var(--iq-primary) !important;
        }

        @keyframes shadow-pulse-dots {
            0% {
                box-shadow: 0 0 0 0px rgba(1, 71, 212, 0.70);
            }
            100% {
                box-shadow: 0 0 0 15px rgba(1, 71, 212, 0.01);
            }
        }
    }


    @media (min-width: 320px) and (max-width: 480px) {
        .menu-social-color {
            color: var(--iq-primary) !important;
        }

        @keyframes shadow-pulse-dots {
            0% {
                box-shadow: 0 0 0 0px rgba(8, 64, 131, 0.53);
            }
            100% {
                box-shadow: 0 0 0 15px rgba(6, 55, 138, 0);
            }
        }
    }

    /*** scrollbar ***/
    body::-webkit-scrollbar-track {
        -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
        border-radius: 10px;
        background-color: #F5F5F5;
    }

    body::-webkit-scrollbar {
        width: 8px;
        background-color: #F5F5F5;
    }

    body::-webkit-scrollbar-thumb {
        border-radius: 10px;
        -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, .3);
        background-color: var(--iq-primary);
    }


    /*** style profile user ***/
    .profile-user {
        font-family: "Rajdhani", sans-serif;
        font-size: 24px !important;
    }

    .info-social-user {
        font-family: "Rajdhani", sans-serif;
        font-size: 14px !important;
    }

    /*.media-support-info u, .media-support-info h5 a{*/
    /*    !*font-family: "roboto", sans-serif !important;*!*/
    /*    font-size: 19px !important;*/
    /*    font-weight: 600;*/
    /*}*/

    .media-support-info p u {
        font-family: "roboto", sans-serif !important;
        font-size: 14px !important;
    }

    .media-support-info p {
        font-size: 12px !important;
    }

    .text-danger.text-errors {
        font-family: "Rajdhani", sans-serif !important;
        font-weight: 500;
        font-size: 13px !important;
    }

    /*** tab profile user ***/
    /*.user-tabing .profile-feed-items {*/
    /*    overflow-x: auto !important;*/
    /*    overflow-y:hidden !important;*/
    /*    flex-wrap: nowrap !important;*/
    /*}*/
    /*.user-tabing .profile-feed-items li a {*/
    /*    white-space: nowrap !important;*/
    /*}*/


    /*** sweetalert2 ***/
    .swal2-popup {
        /*border-radius: 0 !important;*/
        box-shadow: 0px 0px 3px rgba(255, 255, 255, 0.37);
    }

    .swal-notification {
        font-family: "Rajdhani", sans-serif !important;
        font-size: 16px !important;
        font-weight: 300;
    }

    .text-swal, .upload label, .font-rajdhani {
        font-family: "Rajdhani", sans-serif !important;
    }

    .roboto-normal {
        font-family: 'Roboto', sans-serif !important;
    }

    .roboto {
        font-family: 'Roboto', sans-serif !important;
        color: rgba(31, 31, 31, 0.8);
        text-shadow: 0 0 1px rgba(31, 31, 31, 0.60);
    }

    .roboto:hover {
        text-shadow: 0 0 1px rgba(0, 54, 90, 0.60);
    }

    .roboto-link {
        font-family: 'Roboto', sans-serif !important;
        color: rgba(8, 126, 205, 0.6);
        text-shadow: 0 0 1px rgba(8, 126, 205, 0.6);
    }

    .roboto-link:hover {
        text-shadow: 0 0 1px rgba(0, 54, 90, 0.60);
    }

    .weight-200 {
        font-weight: 200;
    }

    .weight-300 {
        font-weight: 300;
    }

    .weight-400 {
        font-weight: 400;
    }


    .weight-500 {
        font-weight: 500;
    }

    .weight-600 {
        font-weight: 600;
    }



    .font-rajdhani-11 {
        font-family: "Rajdhani", sans-serif !important;
        font-size: 11px !important;
    }

    .font-rajdhani-13, p.font-rajdhani-13 u {
        font-family: "Rajdhani", sans-serif !important;
        font-size: 13px !important;
    }
    .font-rajdhani-14, p.font-rajdhani-14 u {
        font-family: "Rajdhani", sans-serif !important;
        font-size: 14px !important;
    }

    .font-rajdhani-16 {
        font-family: "Rajdhani", sans-serif !important;
        font-size: 16px !important;
    }

    .font-rajdhani-18 {
        font-family: "Rajdhani", sans-serif !important;
        font-size: 18px !important;
    }

    .font-rajdhani{
        font-family: "Rajdhani", sans-serif !important;
    }

    .font-10 {
        font-size: 10px;
    }

    .font-12 {
        font-size: 12px;
    }

    /*** select2 ***/
    /*.form-control {*/
    /*    border:1px solid rgba(71, 71, 71, 0.32) !important;*/
    /*    border-radius: 0px;*/
    /*    box-shadow: none !important;*/
    /*    margin-bottom: 15px;*/
    /*}*/

    /*.form-control:focus {*/
    /*    border: 1px solid rgb(13, 45, 98) !important;*/
    /*}*/

    .select2.select2-container {
        width: 100% !important;
    }

    .select2.select2-container .select2-selection {
        border: 1px solid rgba(71, 71, 71, 0.32) !important;
        -webkit-border-radius: 0px;
        -moz-border-radius: 0px;
        border-radius: 0px;
        height: 45px;
        margin-bottom: 15px;
        outline: none !important;
        transition: all .15s ease-in-out;
    }

    .select2.select2-container .select2-selection:focus {
        border: 1px solid rgb(13, 45, 98) !important;
        box-shadow: rgba(13, 45, 98, 0.32) 0px 0px 5px 0px !important;
    }

    .select2.select2-container .select2-selection .select2-selection__rendered {
        color: rgba(71, 71, 71, 0.84);
        line-height: 45px;
        padding-right: 33px;
    }

    .select2.select2-container .select2-selection .select2-selection__arrow {
        background: #f8f8f8;
        border-left: 1px solid #ccc;
        -webkit-border-radius: 0 3px 3px 0;
        -moz-border-radius: 0 3px 3px 0;
        border-radius: 0 3px 3px 0;
        height: 43px;
        width: 33px;
    }

    .select2.select2-container.select2-container--open .select2-selection.select2-selection--single {
        background: #f8f8f8;
    }

    .select2.select2-container.select2-container--open .select2-selection.select2-selection--single .select2-selection__arrow {
        -webkit-border-radius: 0 3px 0 0;
        -moz-border-radius: 0 3px 0 0;
        border-radius: 0 3px 0 0;
    }

    .select2.select2-container.select2-container--open .select2-selection.select2-selection--multiple {
        border: 1px solid #34495e;
    }

    .select2.select2-container .select2-selection--multiple {
        height: auto;
        min-height: 34px;
    }

    .select2.select2-container .select2-selection--multiple .select2-search--inline .select2-search__field {
        margin-top: 0;
        height: 32px;
    }

    .select2.select2-container .select2-selection--multiple .select2-selection__rendered {
        display: block;
        padding: 0 4px;
        line-height: 29px;
    }

    .select2.select2-container .select2-selection--multiple .select2-selection__choice {
        background-color: #f8f8f8;
        border: 1px solid #ccc;
        -webkit-border-radius: 0px;
        -moz-border-radius: 0px;
        border-radius: 0px;
        margin: 4px 4px 0 0;
        padding: 0 6px 0 22px;
        height: 24px;
        line-height: 24px;
        font-size: 12px;
        position: relative;
    }

    .select2.select2-container .select2-selection--multiple .select2-selection__choice .select2-selection__choice__remove {
        position: absolute;
        top: 0;
        left: 0;
        height: 22px;
        width: 22px;
        margin: 0;
        text-align: center;
        color: #e74c3c;
        font-weight: bold;
        font-size: 16px;
    }

    .select2-container .select2-dropdown {
        background: transparent;
        border: none;
        margin-top: -5px;
    }

    .select2-container .select2-dropdown .select2-search {
        padding: 0;
    }

    .select2-container .select2-dropdown .select2-search input {
        outline: none !important;
        border: 1px solid #34495e !important;
        border-bottom: none !important;
        padding: 4px 6px !important;
    }

    .select2-container .select2-dropdown .select2-results {
        padding: 0;
    }

    .select2-container .select2-dropdown .select2-results ul {
        background: #fff;
        border: 1px solid #34495e;
    }

    .select2-container .select2-dropdown .select2-results ul .select2-results__option--highlighted[aria-selected] {
        background-color: #063554;
    }

    /*** form validation ***/

    .is-invalid, .is-invalid:focus {
        box-shadow: rgba(250, 52, 86, 0.12) 0px 0px 5px 0px !important;
        border: 1px solid rgb(250, 52, 86) !important;
    }

    /*** reactions group ***/

    .reaction {
        font-size: 1rem;
        display: inline-flex;
        width: 48px;
        height: 48px;
        color: #fff;
        border-radius: 50%;
        background-color: #ffffff;
        align-items: center;
        justify-content: center;
    }

    .reaction img {
        width: 100%;
        border-radius: 50%;
        padding: 3px;
    }

    .reaction-sm {
        font-size: .875rem;
        width: 30px;
        height: 30px;
    }

    .reaction-group .reaction {
        position: relative;
        z-index: 2;
        border: 1px dashed rgba(6, 53, 84, 0.34);
    }

    .reaction-group .reaction:hover {
        z-index: 3;
    }

    .reaction-group .reaction + .reaction {
        margin-left: -1rem;
    }

    /*** notification animate ***/

    .reactions img:hover, .notification-active {
        animation: shake 1s;
        animation-iteration-count: infinite;
    }

    @keyframes shake {
        0% {
            transform: translate(1px, 1px) rotate(0deg);
        }
        10% {
            transform: translate(-1px, -2px) rotate(-1deg);
        }
        20% {
            transform: translate(-3px, 0px) rotate(1deg);
        }
        30% {
            transform: translate(3px, 2px) rotate(0deg);
        }
        40% {
            transform: translate(1px, -1px) rotate(1deg);
        }
        50% {
            transform: translate(-1px, 2px) rotate(-1deg);
        }
        60% {
            transform: translate(-3px, 1px) rotate(0deg);
        }
        70% {
            transform: translate(3px, 1px) rotate(-1deg);
        }
        80% {
            transform: translate(-1px, -1px) rotate(1deg);
        }
        90% {
            transform: translate(1px, 2px) rotate(0deg);
        }
        100% {
            transform: translate(1px, -2px) rotate(-1deg);
        }
    }

    /*** Chat status ***/
    .iq-profile-avatar.status-offline:before {
        background-color: #e53636;
    }

    /*** Chat date ***/
    .bg-chat-date {
        display: block;
        margin: 50px 0 -15px;
        width: 100%;
        height: 1px;
        border: 0;
        background-color: #063554;
    }

    .bg-chat-date + .chat-date {
        display: inline-block;
        position: relative;
        left: 35%;

        margin: 0;
        padding: 5px 10px;
        border: 0;
        transform: translateX(-50%);
        color: #d3e2ec;
        font-size: 12px;
        font-weight: 500;
        letter-spacing: .32em;
        text-align: center;
        text-transform: uppercase;
        background-color: #063554;
    }

    /*** Note ***/
    .note {
        padding: 10px;
        /*border: 1px solid;*/
        border-left: 6px solid;
        border-radius: 0px;
    }

    .note-primary {
        background-color: var(--iq-light-primary);
        border-color: var(--iq-primary);
        color: #00558f;
    }

    .note-danger {
        background-color: var(--iq-light-danger);
        border-color: var(--iq-danger);
        color: #cd525d;
    }

    .note-success {
        background-color: var(--iq-light-success);
        border-color: var(--iq-success);
        color: #2a7a59;
    }

    ::-ms-reveal {
        display: none;
    }

    /*** Password Validations ***/
    .form-control.border-invalid {
        border-color: var(--iq-danger) !important;
    }

    .icon-button__badge {
        position: absolute;
        top: 19px;
        left: 0px;
        width: 17px;
        height: 17px;
        background: var(--iq-danger);
        color: #ffffff;
        font-size: 8px;
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 50%;
    }

    .btn-google {
        color: #fff;
        background-color: #BF211E;
        border-color: #BF211E;
    }

    .btn-google:hover {
        color: #fff;
        background-color: #E34133;
        border-color: #E34133;
    }

    /*** emojis ***/
    .media-emoji img {
        padding: 5px;
        border: 1px dashed rgba(59, 63, 92, 0.15);
        margin-top: 1px;
        margin-bottom: 2px;
    }

    .media-emoji img:hover {
        background-color: rgba(59, 63, 92, 0.12);
    }

    .tooltip-inner {
        max-width: 40em;
    }

    .tooltip.bs-tooltip-bottom .arrow:before {
        border-bottom-color: var(--iq-primary) !important;
    }

    .text-youtube {
        color: #FF0000 !important;
    }

    .text-gdrive {
        color: #0063D3 !important;
    }

    .bg-gdrive {
        background-color: #0063D3 !important;
    }

    /*** progress bar upload ***/
    .progress-outer {
        background: #fff;
        padding: 5px 60px 5px 5px;
        border: 2px solid #bebfbf;
        border-radius: 45px;
        margin-bottom: 5px;
        position: relative;
    }

    .progress {
        background: #bebfbf;
        border-radius: 20px;
        margin: 0;
    }

    .progress .progress-bar {
        border-radius: 20px;
        box-shadow: none;
        animation: animate-positive 2s;
    }

    .progress .progress-value {
        font-size: 18px;
        font-weight: 400;
        color: #6b7880;
        position: absolute;
        top: 12px;
        right: 10px;
    }

    .progress-bar {
        animation: reverse progress-bar-stripes 0.40s linear infinite, animate-positive 2s;
    }
</style>
