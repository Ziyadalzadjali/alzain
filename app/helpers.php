<?php

if (! function_exists('omr')) {
    /**
     * Format an amount as Omani Rial.
     */
    function omr(float|string|null $amount): string
    {
        $value = number_format((float) $amount, 3, '.', ',');

        return app()->getLocale() === 'ar'
            ? $value.' ر.ع'
            : 'OMR '.$value;
    }
}

if (! function_exists('locale_dir')) {
    function locale_dir(): string
    {
        return app()->getLocale() === 'ar' ? 'rtl' : 'ltr';
    }
}
