export default (money) => {
    return Number(money.replace('R$', '').replace(',', '').replace('.' , '') ) / 100;
}