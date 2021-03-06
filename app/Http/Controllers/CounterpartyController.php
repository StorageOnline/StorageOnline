<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Counterparty;

class CounterpartyController extends Controller
{
    public function __construct(Counterparty $counterparty)
    {
        parent::__construct();
        $this->model = $counterparty;
    }

    public function index()
    {
        $counterparties = $this->model->paginate(10);
        $counterpartyInfo['counterparties'] = $counterparties;
        // html код пагинации на странице
        $counterpartyInfo['render'] = $counterparties->render();

        return view('counterparty', $counterpartyInfo);
    }

    /**
     * Сохранение информации при добавлении или редактировании контрагента
     */
    public function setCounterparty(Request $request)
    {
        $id = $request->counterparty_id;
        $type = $request->counterparty_type;
        $name = $request->counterparty_name;
        $tel = $request->counterparty_tel;
        $email = $request->counterparty_email;

        if($id) {
            $counterparty = Counterparty::find($id);
            $counterparty->type = $type;
            $counterparty->name = $name;
            $counterparty->tel = $tel;
            $counterparty->email = $email;
        } else {
            $counterparty = new Counterparty();

            $counterparty->type = $type;
            $counterparty->name = $name;
            $counterparty->tel = $tel;
            $counterparty->email = $email;
        }
        $counterparty->save();

        $counterparty = $this->getAllCounterparty();

        return $counterparty;

    }

    /**
     * Получение данных по конкретному контрагенту
     */
    public function getCounterparty(Request $request)
    {
        $id = $request->id;

        $counterpartyInfo = Counterparty::find($id);
        $counterparty = $counterpartyInfo->toArray();

        return $counterparty;
    }

    /**
     * Удаление контрагента
     */
    public function delCounterparty(Request $request)
    {
        $id = $request->id;

        if(Counterparty::destroy($id)) {
            return $this->getAllCounterparty();
        }
    }

    /**
     * Получение списка всех контрагентов
     *
     * @return array
     */
    public function getAllCounterparty()
    {
        $items = Counterparty::all();
        $counterparty = $items->toArray();

//        dump($products);
        return $counterparty;
    }

    public function search(Request $request)
    {
        $request_search = '%'.$request->search.'%';
        $items = Counterparty::where(function($q) use ($request_search){
            $q->where('name', 'LIKE', $request_search);
        })->paginate(10);

        return $items;
    }
}
