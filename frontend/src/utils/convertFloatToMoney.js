export default (float) => {
    return Number(float).toLocaleString('pt-br',{style: 'currency', currency: 'BRL'})
}