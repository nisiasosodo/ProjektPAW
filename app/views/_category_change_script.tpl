<script>
    function handleCategoryChange(selectedCategoryId) {
        if (!selectedCategoryId) {
            
            console.log("Nie wybrano kategorii.");
            return;
        }

        const selectElement = document.getElementById('category_id');
        const selectedOption = selectElement.options[selectElement.selectedIndex];
        const selectedType = selectedOption.dataset.type; 

        if (!selectedType) {
            console.error("Brak przypisanego typu dla wybranej kategorii.");
            return;
        }

        
        const noteIdInput = document.querySelector('input[name="id"]');
        const noteId = noteIdInput ? noteIdInput.value : null;

        
        const tempForm = document.createElement('form');
        tempForm.method = 'GET'; 

        if (noteId) {
            
            tempForm.action = "{$conf->action_root}noteEdit/" + noteId;
            const idInput = document.createElement('input');
            idInput.type = 'hidden';
            idInput.name = 'id';
            idInput.value = noteId;
            tempForm.appendChild(idInput);
        } else {
            
            tempForm.action = "{$conf->action_root}noteNew";
        }
        
        
        const categoryInput = document.createElement('input');
        categoryInput.type = 'hidden';
        categoryInput.name = 'category_id';
        categoryInput.value = selectedCategoryId;
        tempForm.appendChild(categoryInput);

        const typeInput = document.createElement('input');
        typeInput.type = 'hidden';
        typeInput.name = 'type'; 
        typeInput.value = selectedType;
        tempForm.appendChild(typeInput);

        document.body.appendChild(tempForm);
        tempForm.submit();
    }

    
    
    document.addEventListener('DOMContentLoaded', function() {
        
        
    });
</script>
