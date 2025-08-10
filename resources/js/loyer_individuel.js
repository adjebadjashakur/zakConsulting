
document.addEventListener('DOMContentLoaded', function() {
    const loyer_individuel = document.getElementById('loyer_individuel');
    const caution = document.getElementById('caution');
    
    function calculeCaution() {
        const loyer = parseFloat(loyer_individuel.value) || 0;
        if (loyer > 0 && caution.value === '') {
            caution.placeholder = `Par défaut: ${(loyer * 3 * 0.10).toFixed(1)} FCFA`;
        }
    }
    loyer_individuel.addEventListener('input', calculeCaution);
    loyer_individuel.addEventListener('change', calculeCaution);
    
    
    calculeCaution();
});