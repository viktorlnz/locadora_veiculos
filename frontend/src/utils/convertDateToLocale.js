export default dt => {
    const dtSplit = dt.split(' ').length > 1 ? dt.split(' ')[0].split('-') : dt.split('-');
    return dtSplit[2] + '/' + dtSplit[1] + '/' + dtSplit[0]
}