

addEventListener('DOMContentLoaded',()=>{
    const btn_menu=document.querySelector('.btn_menu')
    if(btn_menu){
        btn_menu.addEventListener('click',()=>{
            const menu_items=document.querySelector('.menu_items')
            menu_items.classList.toggle('show')

        });
    };

    const cookies = document.cookie.split(';');
    let cookie = null;
    actualizarCarritoUI();
    cookies.forEach(item =>{
        if(item.indexOf('items') > -1){
            cookie = item;
        }
    });
    if(cookie != null){
        const count = cookie.split('=')[1];
        console.log(count);
    }
});



function actualizarCarritoUI(){
    fetch('http://localhost:8081/croso3/api/carrito/api-carrito.php?action=mostrar')
    .then(response =>{
        return response.json();
    })
    .then(data =>{
        console.log(data);
        let tablaCont = document.querySelector('#tabla');
        let subtotal = document.querySelector('#subtotal');
        let precioTotal = '';
        let html = ``;
        data.items.forEach(element => {
            html += `
                <div class="product">
                    <div class="alerta">
                    <a><img src='../img/${element.imagen}'/></a>
                    <div style="flex-direction:column;display: flex;justify-content: left; width: 100%; ">
                        <div class='info'>
                            <input type='hidden' value='${element.id}' />
                            <a><h2>${element.nombre}</h2></a>
                            <div style=" align-items: center; margin-left: 10px; flex-direction:row;display: flex;justify-content: left;">
                            <div>${element.cantidad} items de $${element.precio}</div>
                            
                        </div>
                        
                            <div style="margin-left: 20px" class="botones"><button style=" background: #1D9ED3;
                            padding: 5px 10px;
                            color: white;
                            justify-content: center;
                            border-radius: 15px;
                            border-style: none;
                            left: 38%;
                            font-weight: bold;
                            font-size: 12px;" id="agg" class="align-items-end">Agregar 1 al carrito</button></div>
                            
                            
                            <div style="margin-left: 20px; margin-top:5px;" class='botones'><button style=" background: #b91d1d;
                            padding: 5px 10px;
                            color: white;
                            justify-content: center;
                            border-radius: 15px;
                            border-style: none;
                            left: 38%;
                            font-weight: bold;
                            font-size: 12px;" class='btn-remove'>Quitar 1 del carrito</button></div>
                           
                         </div>
                        </div>
                    </div>
                    <hr>
                        <a>
                            <p>Costo: $${element.subtotal}</p>
                        </a>
                </div>
                
            `;
        });

        
        
        precioTotal = `

            <div class="paga" >
                <h2>${data.info.count} productos</h2>
                <h2>Subtotal: $${data.info.total}</h2>
                
                <input class='subt' name='subtotal' type='hidden' value='${data.info.total}'/>
            </div>
            <button type="submit">Proceder al pago</button>
            <!--a href="proceder-pago.php">Proceder al pago</a-->

            
        
        `;
        tablaCont.innerHTML = html;

        subtotal.innerHTML = precioTotal;

        document.querySelectorAll('.btn-remove').forEach(boton =>{
            boton.addEventListener('click', () => {
                const id = boton.parentElement.parentElement.children[0].value;
                removeItemFromCarrito(id);
            })
        });

        document.querySelectorAll('.align-items-end').forEach(boton=>{
            boton.addEventListener('click', () => {
                const id = boton.parentElement.parentElement.children[0].value;
                addItemToCarrito(id);
            })
        });
    });
}

/*const botones = document.querySelectorAll('.align-items-end');

botones.forEach(boton => {
    const id = boton.parentElement.parentElement.children[0].children[0].value;

    boton.addEventListener('click', e =>{
        addItemToCarrito(id);
    });
});*/


const addItemToCarrito = id =>{
    fetch('http://localhost:8081/croso3/api/carrito/api-carrito.php?action=add&id=' + id)
    .then(response =>{
        return response.text();
    })
    .then(data =>{
        actualizarCarritoUI();
    });
};

const removeItemFromCarrito = id =>{
    fetch('http://localhost:8081/croso3/api/carrito/api-carrito.php?action=remove&id=' + id)
    .then(res =>{
        return res.json();
    })
    .then(data =>{
        console.log(data.statuscode);
        actualizarCarritoUI();
    });
};
//const categoria = document.getElementById("ord");

/*categoria.addEventListener("onchange",(e)=>{
    prompt("si chucha");
});*/

//var nose = categoria();
/*

function categoria(){
    var categoria = document.getElementById("ord").value;
    prompt(categoria);
};*/
 
//----------------------------------------------------------------------------------------




