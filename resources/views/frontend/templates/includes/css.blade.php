<style>
    ::-webkit-scrollbar-track { -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3); box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3); border-radius: 10px; background-color: #ffdeff; }
    ::-webkit-scrollbar { width: 9px; background-color: #F5F5F5; }
    ::-webkit-scrollbar-thumb { border-radius: 10px; -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3); box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3); background-color: #2f55d4; }

    #loadingDiv {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 99999999;
        background: #fff;
        background-image: url("{{asset('frontend/img/dash-loader-large.gif')}}");
        background-position: center;
        background-repeat: no-repeat;
        opacity: 1;
    }
    .cookie-consent {
        position: fixed;
        z-index: 9999;
        bottom: 0;
        background: #2f55d4;
        width: 100%;
        text-align: center;
        padding: 10px 15px;
        color: #fff;
        font-family: Montserrat-Medium;
    }
    .cookie-consent button {
        border: none;
        border-radius: 4px;
        color: #2f55d4;
        background: #fff;
        line-height: 1;
        padding: 12px 18px;
        font-size: 14px;
        font-family: Montserrat-Bold;
    }
    .colorpicker {
        z-index: 2;
    }
    span.invalid-feedback {
        font-family: Montserrat-Medium;
        font-size: 15px
    }
    .item-theme.active > div{
        background: linear-gradient(90deg, rgba(255,255,255,0) 0%, rgba(36,54,208,0.6558998599439776) 0%);
        border-radius: 5px;
    }
    .item-theme i {
        display: none;
    }
    .item-theme.active i {
        display: inline-block;
        font-size: 100px;
        color: #fff;
    }
    .item-theme iframe {
        position: absolute;
        top: -296px;
        left: -453px;
        width: calc(100% * 4.5);
        height: calc(100% * 4.5);
        transform: scale(0.22);
    }
    @if(isset($user) && $user->theme)
        @if(array_key_exists('theme_color', $user->theme))
        .templateSec .templateView {
            background-color: {{$user->theme['theme_color']}};
        }
        @endif
        @if(array_key_exists('theme_button', $user->theme))
        .templateSec .templateView.bg-bluee .d-flex .profileContents .textContents .socilaHolder ul, .templateSec .templateView.bg-bluee .d-flex .btnHolder .btnColor, .templateSec .templateView .btnHolder .btnColor {
            background-color: {{$user->theme['theme_button']}};
            border-color: {{$user->theme['theme_border']}};
        }
        @endif
    @endif
    @media (min-width: 1920px) {
        .item-theme iframe {
            top: -368px;
            left: -498px;
            width: calc(100% * 3.33);
            height: calc(100% * 3.33);
            transform: scale(0.3);
        }
    }
</style>
