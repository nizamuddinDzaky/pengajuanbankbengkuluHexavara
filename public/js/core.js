function sweet_alert(icon = 'success', title , text, showCancelButton =  false, cancelButtonText ='Tidak', confirmButtonText = 'OK'){
    return Swal.fire({
        title: title,
        text: text,
        icon: icon,
        reverseButtons: !0,
        showCancelButton : showCancelButton,
        cancelButtonText : cancelButtonText,
        confirmButtonText : confirmButtonText
    })
}