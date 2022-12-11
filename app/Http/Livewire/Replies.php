<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Replies extends Component
{
    // 前端的 textarea 有設定 wire:model="content"
    // 代表 textarea 的 value 會與 Replies 類別的屬性 $content 值是同步的
    public $content;

    // 表單內容的驗證規則
    protected $rules = [
        'content' => ['required', 'min:2', 'max:400'],
    ];

    // 驗證失敗的錯誤訊息
    protected $messages = [
        'content.required' => '請填寫回覆內容',
        'content.min' => '回覆內容至少 2 個字元',
        'content.max' => '回覆內容至多 400 個字元',
    ];

    // 即時判斷表單內容是否符合 $rules
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    
    public function render()
    {
        return view('livewire.replies');
    }
}
