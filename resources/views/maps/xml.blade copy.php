<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<pju>
@foreach($markers as $marker)
    <marker 
        id="{{ $marker->id }}" 
        name="{{ htmlspecialchars($marker->name) }}" 
        address="{{ htmlspecialchars($marker->address) }}" 
        lat="{{ $marker->lat }}" 
        lng="{{ $marker->lng }}" 
    />
@endforeach
</pju>