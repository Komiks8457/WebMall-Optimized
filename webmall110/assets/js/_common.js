//아이템 검색 체크
function checkSearchForm() {
    switch (getCookie('loc')) {
        case 'us':
            var msg = 'Please enter the words for search.'
            break;
        case 'tr':
            var msg = 'Arama için kelimeleri giriniz.'
            break;
        case 'de':
            var msg = 'Bitte geben Sie das Suchwort ein.'
            break;
        case 'es':
            var msg = 'Por favor, introduzca las palabras para la busqueda.'
            break;
        case 'eg':
            var msg = '.رجاء ادخال الكلمة للبحث'
            break;
        default:
            var msg = 'Please enter the words for search.'
    }
    if (isField($('#searchWord').val()) == 0) {
        modalAlert(msg);
        $('#searchWord').val('');
        $('#searchWord').focus();
        return false;
    }
    return true;
}

function isField(keyword) {

    var st_num, key_len;
    st_num = keyword.indexOf(" ");

    while (st_num != -1) {
        keyword = keyword.replace(" ", "");
        st_num = keyword.indexOf(" ");
    }
    key_len = keyword.length;
    return key_len;
}

//장바구니 추가 함수
function addReserved(element, package_id) {
    $(element).attr("disabled", 'disabled');

    ext = getCookie('ext');
    switch (getCookie('loc')) {
        //msg = 'Reserved에 추가 하시겠습니까?'
        //msg1 = "이미 Reserved에 추가 되어있습니다"
        //msg3 = "레벨 제한 아이템 이야~"
        case 'us':
            var msg = 'Added on the Reserved.\nDo you want to check?'
            var msg1 = 'Selected items are already on Reserved'
            var msg2 = 'You can keep maximum 20 items in the Reserved.\nIf you want to keep another item more. Please remove any other items.'
            var msg3 = 'It is not sufficient level for purchase items.\nPlease check the details by restriction of item description.'
            break;
        case 'de':
            var msg = 'Reserv litesine eklendi.Kontrol etmek istermisiniz?'
            var msg1 = 'Die ausgewählten Items sind bereits Reserviert'
            var msg2 = 'Sie können bis zu 20 Items in der Reservierung halten.\nWenn Sie zusätliche Items behalten wollen entfernen Sie bitte andere Items.'
            var msg3 = 'Nicht erhältlich für dieses Level.\nBitte prüfen Sie die Details der Einschränkungen für Items'
            break;
        case 'tr':
            var msg = 'Wurde zur überarbeiteten Liste hinzugefügt. \nWillst Du es überprüfen?'
            var msg1 = 'Seçilen öğeler zaten ayrılmış'
            var msg2 = 'Rezervde maksium 20 adet öğe tutabilirsiniz.\n Eğer diğer öğelerden daha fazla tutmak istiyorsanız,lütfen bazı öğeleri siliniz.'
            var msg3 = 'Mevcut seviyede satın alamaz.\nDetaylı bilgi için lütfen Öğe açıklamanın Sınırlama bölümü kontrol edin.'
            break;
        case 'es':
            var msg = 'Agregado en la lista de reservados.\n¿Quieres comprobar?'
            var msg1 = 'Los elementos seleccionados ya estan en Reservados'
            var msg2 = 'Se puede guardar un máximo de 20 items en Reservados.\n Si desea guardar un item más, por favor, quitar otro item.'
            var msg3 = 'Esto no está disponible para su compra en este nivel.\nPor favor, revise las restricciones en la descripción del artículo.'
            break;
        case 'eg':
            var msg = 'أضافة على لائحة المحفوظة.\n هل تريد أن تحقق؟'
            var msg1 = 'السلع المختارة تم حجزه'
            var msg2 = 'مكنك الاحتفاظ الحد الأقصى ٥٠ في الأدوات المحفوظة.\nإذا كنت تريد أن تبقي أدوات آخر، الرجاء إزالة أية أداة.'
            var msg3 = 'المستوى غير متوفرة للشراء.يرجى التحقق من التفاصيل عن طريق التقييد\nمن وصف السلعة.'
            break;
        default:
            var msg = 'Added on the Reserved.\nDo you want to check?'
            var msg1 = 'Selected items are already on Reserved'
            var msg2 = 'You can keep maximum 20 items in the Reserved.\nIf you want to keep another item more. Please remove any other items.'
            var msg3 = 'It is not sufficient level for purchase items.\nPlease check the details by restriction of item description.'
    }
    $.ajax({
        type: "POST",
        url: 'addtocart.html',
        data: {cart:package_id},
        success: function (res) {
            switch(res.response)
            {
                case 0:
                    modalAlert(msg, null, true, function(e){
                        if (e === true)
                            gotoLocation(null, 'itembuygame.html?st3=3');
                    });  
                    break;
                case -1:
                    modalAlert(msg1);
                    break;
                case -2:
                    modalAlert(msg2);
                    break;
                case -3:
                    modalAlert(msg3);
                    break;
                default:
                    modalAlert('Unknown error, please try again!.');
            }
        }
    });

    $(element).removeAttr("disabled");
}

function getCookie(name) {
    var nameOfCookie = name + "=";
    var x = 0;
    while (x <= document.cookie.length) {
        var y = (x + nameOfCookie.length);
        if (document.cookie.substring(x, y) == nameOfCookie) {
            if ((endOfCookie = document.cookie.indexOf(";", y)) == -1)
                endOfCookie = document.cookie.length;
            return unescape(document.cookie.substring(y, endOfCookie));
        }
        x = document.cookie.indexOf(" ", x) + 1;
        if (x == 0)
            break;
    }
    return "";
}

function modalAlert(contents, title, okcancel, callback) {
    // Defaults
    title = title || 'Confirmation';
    okcancel = okcancel !== undefined ? okcancel : false;
    callback = typeof callback === 'function' ? callback : function() {};

    $('.modalAlert .title .val').html(title.replace(/\n/g, '<br>'));
    $('.modalAlert .content .val').html(contents.replace(/\n/g, '<br>'));

    if (!okcancel) {
        $('.modalAlert #cancel').hide();
    } else {
        $('.modalAlert #cancel').show();
    }
    
    $('.modalAlert #cancel').unbind('click').click(function () {
        $('.modalAlert').hide();
        if (typeof callback === 'function') {
            callback(false);
        }
        return false;
    });
    
    $('.modalAlert #ok').unbind('click').click(function () {
        $('.modalAlert').hide();
        if (typeof callback === 'function') {
            callback(true);
        }
        return true;
    });
    
    $('.modalAlert').show();
}

function gotoLocation(element, url) {
    //Disabling the element prevents multiple clicks
    if (element !== undefined)
        $(element).attr("disabled", 'disabled');

    location.href = url;
}

function itemBuy(element, url, package_id, buytype) {
    //Disabling the element prevents multiple clicks
    $(element).attr("disabled", 'disabled');
    $('.btn-ga#item_' + package_id).addClass('disabled');

    var params = $.param({
        st3: 6,
        pid: package_id,
        buy: buytype
    });

    gotoLocation(null, url + '?' + params);
}