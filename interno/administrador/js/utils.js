function formatCurrency(value) {
    return new Intl.NumberFormat('pt-br', {
        currency: 'BRL',
        style: 'currency',
        maximumFractionDigits: 4
    }).format(Number(value || 0));
}
