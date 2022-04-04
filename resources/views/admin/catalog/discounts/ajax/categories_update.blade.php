<div class="form-group">
    <label>Select Multiple</label>
    <select multiple="" class="form-control" id="FormChoice">
        @php
            $traverse = function ($categories, $prefix = '-&ensp;', $items_id) use (&$traverse) {
                foreach ($categories as $category) {
                    $selected = in_array($category->id, $items_id) ? 'selected' : '';
                    $option = '<option data-name="'.$category->name.'" value="'.$category->id.'" '.$selected.'>'.PHP_EOL.$prefix.' '.$category->name.'</option>';
                    echo $option;
                    $traverse($category->children, $prefix.'-&ensp;', $items_id);
                }
            };
            $traverse($categories, '-&ensp;', $items_id);
        @endphp
    </select>
</div>
