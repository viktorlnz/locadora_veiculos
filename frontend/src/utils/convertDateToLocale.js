export default dt => {
    const dtSplit = dt.split('-');
    return dtSplit[2] + '/' + dtSplit[1] + '/' + dtSplit[0]
}