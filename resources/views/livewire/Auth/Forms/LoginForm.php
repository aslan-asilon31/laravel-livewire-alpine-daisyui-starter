<?php

namespace App\Livewire\Auth\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class LoginForm extends Form
{
  public string|null $surel = null;
  public string|null $sandi = null;

  public function rules()
  {
    return [
      'loginForm.surel' => 'required|string',
      'loginForm.sandi' => 'required|string',
    ];
  }

  public function attributes()
  {
    return [
      'loginForm.surel' => 'surel',
      'loginForm.sandi' => 'sandi',
    ];
  }
}
