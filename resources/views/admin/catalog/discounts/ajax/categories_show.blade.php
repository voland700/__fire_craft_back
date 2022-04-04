<div class="form-group">
    <label>Select Multiple</label>
    <select multiple="" class="form-control" id="FormChoice">
        @php
            $traverse = function ($categories, $prefix = '-&ensp;') use (&$traverse) {
                foreach ($categories as $category) {
                    $option = '<option data-name="'.$category->name.'" value="'.$category->id.'">'.PHP_EOL.$prefix.' '.$category->name.'</option>';
                    echo $option;
                    $traverse($category->children, $prefix.'-&ensp;');
                }
            };
            $traverse($categories, '-&ensp;');
        @endphp
    </select>
</div>
