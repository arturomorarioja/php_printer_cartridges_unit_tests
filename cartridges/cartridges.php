<?php

// The minimum order quantity is 5. There is a 20% discount for orders of 100 or more printer cartridges.

function calculateDiscount(int $cartridges): float
{
    if ($cartridges < 5) {
        throw new UnexpectedValueException('The minimum order quantity is 5.');
    }

    if ($cartridges >= 100) {
        return 0.2;
    }
    return 0.0;
}