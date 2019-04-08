
window.setupIcEnfoldVslider = function(av_uid) {
    const template = document.querySelector(`#${av_uid}`);
    const el = document.createElement('div');
    template.parentNode.appendChild(el);
    
    new Vue({
        el,
        template,
    })
}