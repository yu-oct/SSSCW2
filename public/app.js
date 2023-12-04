document.addEventListener('DOMContentLoaded', function () {
    // 检查是否存在错误
    if (typeof errors !== 'undefined' && errors.length > 0) {
        // 创建提示弹窗
        var alertContainer = document.createElement('div');
        alertContainer.classList.add('alert-container');
        alertContainer.innerHTML = '<strong>Error!</strong><ul>';

        // 将错误信息添加到弹窗中
        errors.forEach(function (error) {
            alertContainer.innerHTML += '<li>' + error + '</li>';
        });

        alertContainer.innerHTML += '</ul>';

        // 将弹窗添加到页面
        document.body.appendChild(alertContainer);

        // 设置定时器，5 秒后移除弹窗
        setTimeout(function () {
            alertContainer.remove();
        }, 5000);
    }
});
//上传文件，获取文件名
function changeAgentContent(inputElementId) {
    document.getElementById("inputFileAgent").value = document.getElementById(inputElementId).value;
}

$(function () {
    $("#sortable-list").sortable();
});