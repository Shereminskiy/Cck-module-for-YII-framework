    <div class="row">
        <?php
            if(isset($attributes["fields"])) {
                foreach($attributes["fields"] as $key => $field) {
                    echo $form->labelEx($model, $field["label"]);
                    $model[$key] =  $field["value"];
                    echo $form->$field["type"]($model, $key);
                    if(isset($field["description"]))
                        echo "<div>".$field["description"]."</div>";
                    echo $form->error($model, $key);
                }
            }
        ?>
    </div>