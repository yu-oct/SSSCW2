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

// $(function () {
//     $("#sortable-list").sortable();
// });
// 假设这是你的提交按钮
// var submitButton = document.getElementById('submit-button');
// // 在按钮点击事件中显示弹窗，并在两秒后隐藏
// submitButton.addEventListener('click', function () {
//     // 你的提交逻辑...

//     // 假设提交成功后，显示弹窗
//     var successModal = document.getElementById('success-modal');
//     successModal.classList.remove('hidden');

//     // 两秒后隐藏弹窗
//     setTimeout(function () {
//         successModal.classList.add('hidden');
//     }, 2000);
// });
function submitFeedback() {
    // 在这里添加你的 JavaScript 逻辑，例如弹窗
    alert('Feedback Submitted!');
}