let itemPrices = [];
let itemNums = [];

document.addEventListener("cart_item_num_changed", function(){
    let subtotal = 0;
    for(let i = 0; i < itemPrices.length; i++){
        subtotal += (itemPrices[i] * itemNums[i]);
    }

    const subtotalShow = document.getElementById("subtotal");
    let subtotalCurrency = subtotal.toLocaleString('id-ID', {
        style: "currency",
        currency: "IDR",
    });

    subtotalShow.innerText = subtotalCurrency;
});

document.addEventListener("DOMContentLoaded", function(){
    const items = document.getElementsByClassName("cart-item-num-input");
    const prices = document.querySelectorAll("#item-price");

    for(let i = 0; i < items.length; i++){
        itemNums[i] = parseInt(items[i].value);
        itemPrices[i] = parseInt(prices[i].value);
    }

    document.dispatchEvent(new Event("cart_item_num_changed"));
});

function addItem(looperId){
    const itemNum = document.getElementById("itemNum_" + looperId.toString());
    const oldNum = parseInt(itemNum.value);
    const newNum = oldNum + 1;

    itemNum.value = newNum.toString();
    itemNums[looperId - 1] += 1;

    document.dispatchEvent(new Event("cart_item_num_changed"));
};

function subtractItem(looperId){
    const itemNum = document.getElementById("itemNum_" + looperId.toString());
    const oldNum = parseInt(itemNum.value);

    if(oldNum > 1){
        const newNum = oldNum - 1;
        itemNum.value = newNum.toString();
        itemNums[looperId- 1] -= 1;

        document.dispatchEvent(new Event("cart_item_num_changed"));
    }
};

function show(){
    for(let i = 0; i < itemPrices.length; i++){
        console.log("Price: " + itemPrices[i] + ", num: " + itemNums[i]);
    }
}
