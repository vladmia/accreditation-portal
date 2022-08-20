    <div class="species__container emails">
        <div class="group">
       <?php
            echo '<div class="species-group emails" id="grp-1"><span style="display:none" class="species_category"></span><input type="email" class="eval__email" placeholder="e.g johnDoe@gmail.com" required>' .
                '<button type="button" class="minus emails" id="minus1" onclick="remove(this.getAttribute(\'id\'));">-</button><button style="color: green"  type="button" class="add emails" id="add1" onclick="populate(this.getAttribute(\'id\'));">+</button></div>';
        ?>
        </div>
    </div>


