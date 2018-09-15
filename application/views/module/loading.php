<style type="text/css">
        	/*----------------mui.showLoading---------------*/
    .mui-show-loading {
        position: fixed;
        padding: 5px;
        width: 120px;
        min-height: 120px;
        top: 45%;
        left: 50%;
        margin-left: -60px;
        background: rgba(0, 0, 0, 0.6);
        text-align: center;
        border-radius: 5px;
        color: #FFFFFF;
        visibility: hidden;
        margin: 0;
        z-index: 2000;

        -webkit-transition-duration: .2s;
        transition-duration: .2s;
        opacity: 0;
        -webkit-transform: scale(0.9) translate(-50%, -50%);
        transform: scale(0.9) translate(-50%, -50%);
        -webkit-transform-origin: 0 0;
        transform-origin: 0 0;
    }
    .mui-show-loading.loading-visible {
        opacity: 1;
        visibility: visible;
        -webkit-transform: scale(1) translate(-50%, -50%);
        transform: scale(1) translate(-50%, -50%);
    }
    .mui-show-loading .mui-spinner{
        margin-top: 24px;
        width: 36px;
        height: 36px;
    }
    .mui-show-loading .text {
        line-height: 1.6;
        font-family: -apple-system-font,"Helvetica Neue",sans-serif;
        font-size: 14px;
        margin: 10px 0 0;
        color: #fff;
    }

    .mui-show-loading-mask {
      position: fixed;
      z-index: 1000;
      top: 0;
      right: 0;
      left: 0;
      bottom: 0;
    }
    .mui-show-loading-mask-hidden{
        display: none !important;
    }
</style>
<script type="text/javascript" >
(function($, window) {
    //显示加载框
    $.showLoading = function(message,type) {
        if ($.os.plus && type !== 'div') {
            $.plusReady(function() {
                plus.nativeUI.showWaiting(message);
            });
        } else {
            var html = '';
            html += '<i class="mui-spinner mui-spinner-white"></i>';
            html += '<p class="text">' + (message || "数据加载中") + '</p>';

            //遮罩层
            var mask=document.getElementsByClassName("mui-show-loading-mask");
            if(mask.length==0){
                mask = document.createElement('div');
                mask.classList.add("mui-show-loading-mask");
                document.body.appendChild(mask);
                mask.addEventListener("touchmove", function(e){e.stopPropagation();e.preventDefault();});
            }else{
                mask[0].classList.remove("mui-show-loading-mask-hidden");
            }
            //加载框
            var toast=document.getElementsByClassName("mui-show-loading");
            if(toast.length==0){
                toast = document.createElement('div');
                toast.classList.add("mui-show-loading");
                toast.classList.add('loading-visible');
                document.body.appendChild(toast);
                toast.innerHTML = html;
                toast.addEventListener("touchmove", function(e){e.stopPropagation();e.preventDefault();});
            }else{
                toast[0].innerHTML = html;
                toast[0].classList.add("loading-visible");
            }
        }   
    };

    //隐藏加载框
      $.hideLoading = function(callback) {
        if ($.os.plus) {
            $.plusReady(function() {
                plus.nativeUI.closeWaiting();
            });
        } 
        var mask=document.getElementsByClassName("mui-show-loading-mask");
        var toast=document.getElementsByClassName("mui-show-loading");
        if(mask.length>0){
            mask[0].classList.add("mui-show-loading-mask-hidden");
        }
        if(toast.length>0){
            toast[0].classList.remove("loading-visible");
            callback && callback();
        }
      }
})(mui, window);
</script>