<?php
namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class MatchPassword extends Constraint
{
    public $message = 'Les mots de passe ne correspondent pas.';
}
