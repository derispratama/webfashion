function getBrands(){
    $.ajax({
        url:'/api/brands',
        type:'get',
        dataType:'json',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        beforeSend(){
            let html = `<option value="">loading...</td>`;
            $('#id_brand').html(html);
        },
        success(data){
            let html = `<option value="">No Data</td>`;

            const d = data.map((value,key) => {
                return `<option value="${value.id}">${value.name}</td>`;
            });

            if(d.length > 0){
                $('#id_brand').html(d);
            }else{
                $('#id_brand').html(html);
            }
        },
        error(error){
            console.error(error);
        }
    })
}

function getProductCategory(){
    $.ajax({
        url:'/api/product-categories',
        type:'get',
        dataType:'json',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        beforeSend(){
            let html = `<option value="">loading...</td>`;
            $('#id_product_category').html(html);
        },
        success(data){
            let html = `<option value="">No Data</td>`;

            const d = data.map((value,key) => {
                return `<option value="${value.id}">${value.name}</td>`;
            });

            if(d.length > 0){
                $('#id_product_category').html(d);
            }else{
                $('#id_product_category').html(html);
            }
        },
        error(error){
            console.error(error);
        }
    })
}

function getCutting(){
    $.ajax({
        url:'/api/cuttings',
        type:'get',
        dataType:'json',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        beforeSend(){
            let html = `<option value="">loading...</td>`;
            $('#id_cutting').html(html);
        },
        success(data){
            let html = `<option value="">No Data</td>`;

            const d = data.map((value,key) => {
                return `<option value="${value.id}">${value.name}</td>`;
            });

            if(d.length > 0){
                $('#id_cutting').html(d);
            }else{
                $('#id_cutting').html(html);
            }
        },
        error(error){
            console.error(error);
        }
    })
}

function getColor(){
    $.ajax({
        url:'/api/colors',
        type:'get',
        dataType:'json',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        beforeSend(){
            let html = `<option value="">loading...</td>`;
            $('#id_color').html(html);
        },
        success(data){
            let html = `<option value="">No Data</td>`;

            const d = data.map((value,key) => {
                return `<option value="${value.id}" data-name="${value.name}">${value.name}</td>`;
            });

            if(d.length > 0){
                $('#id_color').html(d);
            }else{
                $('#id_color').html(html);
            }
        },
        error(error){
            console.error(error);
        }
    })
}

function getOcassions(){
    $.ajax({
        url:'/api/ocassions',
        type:'get',
        dataType:'json',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        beforeSend(){
            let html = `<option value="">loading...</td>`;
            $('#id_ocassions').html(html);
        },
        success(data){
            let html = `<option value="">No Data</td>`;

            const d = data.map((value,key) => {
                return `<option value="${value.id}">${value.name}</td>`;
            });

            if(d.length > 0){
                $('#id_ocassions').html(d);
            }else{
                $('#id_ocassions').html(html);
            }
        },
        error(error){
            console.error(error);
        }
    })
}

function getSize(){
    $.ajax({
        url:'/api/sizes',
        type:'get',
        dataType:'json',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        beforeSend(){
            let html = `<option value="">loading...</td>`;
            $('#id_size').html(html);
        },
        success(data){
            let html = `<option value="">No Data</td>`;

            const d = data.map((value,key) => {
                return `<option value="${value.id}" data-name="${value.name}">${value.name}</td>`;
            });

            if(d.length > 0){
                $('#id_size').html(d);
            }else{
                $('#id_size').html(html);
            }
        },
        error(error){
            console.error(error);
        }
    })
}

function getArticleCategory(id_article = ''){
    $.ajax({
        url:'/api/article-categories',
        type:'get',
        dataType:'json',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        beforeSend(){
            let html = `<option value="">loading...</td>`;
            $('#id_article_category').html(html);
        },
        success(data){
            let html = `<option value="">No Data</td>`;

            const d = data.map((value,key) => {
                return `<option value="${value.id}">${value.name}</td>`;
            });

            if(d.length > 0){
                $('#id_article_category').html(d);
            }else{
                $('#id_article_category').html(html);
            }
        },
        error(error){
            console.error(error);
        }
    })
}

function getProducts(){
    $.ajax({
        url:'/api/products',
        type:'get',
        dataType:'json',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        beforeSend(){
            let html = `<option value="">loading...</td>`;
            $('#id_article_category').html(html);
        },
        success(data){
            let html = `<option value="">No Data</td>`;

            const d = data.map((value,key) => {
                return `<option value="${value.id}">${value.name}</td>`;
            });

            if(d.length > 0){
                $('#products').html(d);
            }else{
                $('#products').html(html);
            }
        },
        error(error){
            console.error(error);
        }
    })
}


