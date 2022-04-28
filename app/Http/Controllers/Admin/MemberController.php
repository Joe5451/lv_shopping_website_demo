<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Libraries\AdminAuth;
use App\Models\Member;

class MemberController extends Controller
{
    var $main_menu = 'member';
    var $sub_menu = 'member_list';
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
        $data['members'] = Member::orderBy('datetime', 'desc')->get();
        
        return view('admin.member_list', $data);
    }

    public function add_form() {
        $data = $this->head_data;
        
        return view('admin.member_add_form', $data);
    }

    public function add(Request $request) {
        $data = $request->input();
        unset($data['_token']);

        $existMember = Member::where('account', $data['account'])->take(1)->get();

        if (count($existMember) > 0) {
            $this->alertAndHistoryBack('帳號已存在，請重新設置!', 'warning');
            return false;
        }

        $data['password'] = md5($data['password']);
        $data['datetime'] = date('Y-m-d H:i:s');

        if (is_null($data['remark'])) $data['remark'] = '';

        Member::create($data);

        return view('admin.alert', [
            'icon_type' => 'success',
            'message' => '新增成功!',
            'redirect' => route('admin.member_list')
        ]);
    }

    public function update_form($id) {
        $data = $this->head_data;
        $data['member'] = Member::find($id);
        
        return view('admin.member_update_form', $data);
    }

    public function update($id, Request $request) {
        $data = $request->input();

        $existMember = Member::where('account', $data['account'])
        ->where('member_id', '!=', $id)
        ->take(1)->get();

        if (count($existMember) > 0) {
            $this->alertAndHistoryBack('帳號已存在，請重新設置!', 'warning');
            return false;
        }
        
        if (is_null($data['password'])) unset($data['password']);
        else $data['password'] = md5($data['password']);

        if (is_null($data['remark'])) $data['remark'] = '';
        
        unset($data['_token']);
        
        Member::where('member_id', $id)->update($data);

        return view('admin.alert', [
            'icon_type' => 'success',
            'message' => '更新成功!',
            'redirect' => route('admin.member_update_form', $id)
        ]);
    }

    public function batch_action(Request $request) {
        $data = $request->input();
        $action = $request->input('action');

        if ($action == 'none' || $action == '') {
            $this->errorAndRedirectList();
        }

        switch ($action) {
            case 'state_on':
                $result = $this->batch_state_update(1, $request);
                $action_message = '勾選正常';
                break;
            case 'state_off':
                $result = $this->batch_state_update(0, $request);
                $action_message = '勾選停權';
                break;
            default:
        }

        if (!$result) return;

        return view('admin.alert', [
            'icon_type' => 'success',
            'message' => $action_message . '成功!',
            'redirect' => route('admin.member_list')
        ]);
    }

    private function batch_state_update($state, $request) {
        $ids = $request->input('checked_ids');

        if (is_null($ids)) {
            $this->alertAndRedirectList('未勾選項目!', 'warning');
            return false;
        }
        
        Member::whereIn('member_id', $ids)
        ->update([
            'state' => $state
        ]);

        return true;
    }

    private function alertAndRedirectList($message = '操作錯誤!', $icon = 'info') {
        echo view('admin.alert', [
            'icon_type' => $icon,
            'message' => $message,
            'redirect' => route('admin.member_list')
        ]);
    }

    private function alertAndHistoryBack($message = '操作錯誤!', $icon = 'info') {
        echo view('admin.history_back', [
            'icon_type' => $icon,
            'message' => $message,
        ]);
    }
}
