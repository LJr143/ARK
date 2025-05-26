<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['content']));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter((['content']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>

<p class="<?php echo \Illuminate\Support\Arr::toCssClasses([
    'mt-1 text-sm leading-5',
    'text-slate-500' => config('notify.theme') === 'light',
    'text-white' => config('notify.theme') !== 'light',
]); ?>">
    <?php echo e($content); ?>

</p>
<?php /**PATH C:\laragon\www\ARK\vendor\mckenziearts\laravel-notify\src/../resources/views/components/notify-content.blade.php ENDPATH**/ ?>