
setTimeout(() => {
    if(!(document.getElementById('true')==null)){
        document.getElementById('true').remove();
    }else if(!(document.getElementById('false')===null)){
        document.getElementById('false').remove();
    }
}, 4000);

let questionCounter = 2;
function addQuestion(){
    var newQuestion=document.createElement('div');
    newQuestion.innerHTML=
        `<div>
            <fieldset>
                <legend>Question ${questionCounter++}</legend>
                <div class="display-flex">
                    <textarea name="questions[]" rows="2" placeholder="Write your question" class="form-input questions"
                        required></textarea>
                </div>
                
                <div class="display-flex">
                    <input type="radio" name="correct[${questionCounter-2}]" value="1" required>
                    <input type="text" name="option_1[]" placeholder="Option 1" class="form-input answers" required>
                    
                    <input type="radio" name="correct[${questionCounter-2}]" value="2">
                    <input type="text" name="option_2[]" placeholder="Option 2" class="form-input answers" required>
                </div>
                
                <div class="display-flex">
                    <input type="radio" name="correct[${questionCounter-2}]" value="3">
                    <input type="text" name="option_3[]" placeholder="Option 3" class="form-input answers" required>
                    
                    <input type="radio" name="correct[${questionCounter-2}]" value="4">
                    <input type="text" name="option_4[]" placeholder="Option 4" class="form-input answers" required>
                </div>
            </fieldset>
        </div>`;
    document.getElementById("add-question").appendChild(newQuestion);
}