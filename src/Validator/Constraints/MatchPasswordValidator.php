<?php
namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class MatchPasswordValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        $newPassword = $this->context->getRoot()['NewPassword']->getData();
        $confirmNewPassword = $this->context->getRoot()['confirmNewPassword']->getData();
       

        if ($newPassword !== $confirmNewPassword) {
            $this->context->buildViolation($constraint->message)
                ->addViolation();
        }
    }
}
