<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Libraries\AdminAuth;
use App\Models\Contact;

class ContactController extends Controller
{
    var $main_menu = 'contact';
    var $sub_menu = 'contact_list';
    var $head_data = [];
    
    public function __construct()
    {
        $this->head_data = [
            'main_menu' => $this->main_menu,
            'sub_menu' => $this->sub_menu,
        ];
    }
    
    public function list(Request $request) {
        $data = $this->head_data;
        $data['contacts'] = Contact::orderBy('datetime', 'desc')->get();
        $data['contact_states'] = Contact::process_states;
        
        return view('admin.contact_list', $data);
    }

    public function update_form($id) {
        $data = $this->head_data;
        $data['contact'] = Contact::find($id);
        
        return view('admin.contact_update_form', $data);
    }

    public function update($id, Request $request) {
        $data = $request->input();
        unset($data['_token']);

        Contact::where('id', $id)->update($data);

        return view('admin.alert', [
            'icon_type' => 'success',
            'message' => '更新成功!',
            'redirect' => route('admin.contact_update_form', $id)
        ]);
    }

    public function batch_action(Request $request) {
        $data = $request->input();
        $action = $request->input('action');

        if ($action == 'none' || $action == '') {
            $this->errorAndRedirectList();
        }

        switch ($action) {
            case 'display_on':
                $result = $this->batch_display_update(1, $request);
                $action_message = '顯示';
                break;
            case 'display_off':
                $result = $this->batch_display_update(0, $request);
                $action_message = '隱藏';
                break;
            case 'delete':
                $result = $this->batch_delete($request);
                $action_message = '刪除';
                break;
            default:
        }

        if (!$result) return;

        return view('admin.alert', [
            'icon_type' => 'success',
            'message' => $action_message . '成功!',
            'redirect' => route('admin.contact_list')
        ]);
    }

    private function batch_display_update($display, $request) {
        $ids = $request->input('checked_ids');

        if (is_null($ids)) {
            $this->alertAndRedirectList('未勾選項目!', 'warning');
            return false;
        }
        
        Contact::whereIn('id', $ids)
        ->update([
            'display' => $display
        ]);

        return true;
    }

    private function batch_delete($request) {
        $ids = $request->input('checked_ids');

        if (is_null($ids)) {
            $this->alertAndRedirectList('未勾選項目!', 'warning');
            return false;
        }

        Contact::whereIn('id', $ids)->delete();

        return true;
    }

    private function alertAndRedirectList($message = '操作錯誤!', $icon = 'info') {
        echo view('admin.alert', [
            'icon_type' => $icon,
            'message' => $message,
            'redirect' => route('admin.contact_list')
        ]);
    }
    
}
