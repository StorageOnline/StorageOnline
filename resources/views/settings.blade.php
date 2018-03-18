@extends('layouts.app')

@section('content')
    <div class="container small-container">
        <div class="row">
            <div class="col-md-12 small-column">
                <div class="panel panel-default">
                    <div class="panel-heading text-center">{{ trans('menu.settings') }}</div>

                    <div class="panel-body">
                        <div class="alert-danger">
                            @if(session('message'))
                                {{ session('message') }}
                            @endif
                        </div>
                        <div class="row">
                            <ul class="nav nav-tabs tools">
                                <li class="active"><a data-toggle="tab" href="#company">Управление компаниями</a></li>
                                <li><a data-toggle="tab" href="#datas">Персональные данные</a></li>
                                <li><a data-toggle="tab" href="#vars">Переменные</a></li>
                            </ul>
                            <div class="tab-content col-md-12">
                                <div id="company" class="tab-pane fade in active">
                                    <div class="container">
                                        <div class="col-md-6 pLeft0">
                                            <h2>Управление компаниями</h2> 
                                            
                                        </div>                                     

                                        <div class="col-md-6 add-btn-row pRight0"><a  data-toggle="tooltip" href="#modal" data-toggle="modal" onclick="" class="btn btn-success add-new-company" data-original-title="Добавить новую компанию"><i class="fa fa-plus"></i></a>
                                        </div>
                                       

                                    </div>
                                    
                                    <div class="col-md-6 company-block">
                                        <div class="col-md-12 company-item">
                                            <div class="row">
                                                <div class="col-md-8 col-xs-8 descripton-company">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <h2>Компашка-алкашка</h2>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-xs-4 company-logo">
                                                    <h2>
                                                    <img src="../../img/company-logo/company1.png" alt="">
                                                    </h2>
                                                </div> 
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <input id="name-company" class="bold uppercase" type="text" value="Алкаши бывалые">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <label for="version" class="bold">Version:</label>
                                                            <input id="version" type="text" value="1.0">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <label for="" class="bold">Достижения:</label>
                                                            <input id="" type="text" value="9 литров залпом / мин">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <label for="" class="bold">Мировоззрение:</label>
                                                            <input id="" type="text" value="Миром правит алкоголь">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <label for="" class="bold">Дата создания:</label>
                                                            <input id="" type="text" value="2018.03.17 / 2018.03.17">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 control-block">
                                                    <button type="button" class="btn btn-oval btn-success" onclick="setCompany(2)">Выбрать</button>
                                                    <button type="button" class="btn btn-oval btn-primary">Редактировать</button>
                                                    <button type="button" class="btn btn-oval btn-danger">Удалить</button>
                                                </div> 
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 company-block">
                                        <div class="col-md-12 company-item">
                                            <div class="row">
                                                <div class="col-md-8 col-xs-8 descripton-company">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <h2>Компашка-алкашка</h2>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-xs-4 company-logo">
                                                    <h2>
                                                    <img src="../../img/company-logo/company1.png" alt="">
                                                    </h2>
                                                </div> 
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <input id="name-company" class="bold uppercase" type="text" value="Алкаши бывалые">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <label for="version" class="bold">Version:</label>
                                                            <input id="version" type="text" value="1.0">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <label for="" class="bold">Достижения:</label>
                                                            <input id="" type="text" value="9 литров залпом / мин">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <label for="" class="bold">Мировоззрение:</label>
                                                            <input id="" type="text" value="Миром правит алкоголь">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <label for="" class="bold">Дата создания:</label>
                                                            <input id="" type="text" value="2018.03.17 / 2018.03.17">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 control-block">
                                                    <button type="button" class="btn btn-oval btn-success" onclick="setCompany(3)">Выбрать</button>
                                                    <button type="button" class="btn btn-oval btn-primary">Редактировать</button>
                                                    <button type="button" class="btn btn-oval btn-danger">Удалить</button>
                                                </div> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="datas" class="tab-pane fade personal-info">
                                    <h2 class="container">Персональные данные</h2>
                                    <div class="col-sm-12">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">Личная информация</div>
                                            <div class="panel-body">
                                                <form class="form-horizontal">
                                                    <div class="form-group">
                                                        <label for="login" class="col-lg-2 control-label">Логин</label>
                                                        <div class="col-lg-4">
                                                            <input id="login" type="text" placeholder="Логин" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="name" class="col-lg-2 control-label">Имя</label>
                                                        <div class="col-lg-4">
                                                            <input id="name" type="text" placeholder="Имя" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="surname" class="col-lg-2 control-label">Фамилия</label>
                                                        <div class="col-lg-4">
                                                            <input id="surname" type="text" placeholder="Фамилия" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="gender" class="col-lg-2 control-label gender-label">Пол</label>
                                                        <div class="col-sm-10">
                                                           <label class="radio-inline c-radio">
                                                            <input id="inlineradio3" type="radio" name="i-radio" value="option3" checked>
                                                            <span class="male fa fa-circle"></span>Мужской</label>
                                                            <label class="radio-inline c-radio">
                                                                <input id="inlineradio3" type="radio" name="i-radio" value="option3">
                                                                <span class="fa fa-circle"></span>Женский</label>

                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 col-md-2 control-label birth-day-label">Дата рождения</label>
                                                        <div class="col-sm-9">
                                                           <select id="day" name="day">
                                                              <script>
                                                                  var myDate = new Date();
                                                                  var day = myDate.getDay();
                                                                  for(var i = 1; i <= 31; i++){
                                                                      document.write('<option value="'+i+'">'+i+'</option>');
                                                                  }
                                                              </script>
                                                          </select>

                                                          <select id="month" name="month">
                                                            <script>
                                                                  var month = ["Январь","Февраль","Март","Апрель","Май","Июнь","Июль","Август","Сентябрь","Октябрь","Ноябрь","Декабрь"];
                                                                  for(var i = 0; i < month.length; i++){
                                                                      document.write('<option value="'+month[i]+'">'+month[i]+'</option>');
                                                                  }
                                                              </script>
                  
                                                          </select>

                                                         <select id="year" name="year">
                                                          <script>
                                                              var myDate = new Date();
                                                              var year = myDate.getFullYear();
                                                              for(var i = 1960; i < year+1; i++){
                                                                  document.write('<option value="'+i+'">'+i+'</option>');
                                                              }
                                                          </script>
                                                          </select>
                                                      </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="work-experience" class="col-lg-2 control-label">Стаж работы</label>

                                                        <div class="col-lg-10">
                                                            <select id="work" name="work">
                                                            <script>
                                                                  for(var i = 1; i <=20; i++){
                                                                      
                                                                      if(i==1){
                                                                        document.write('<option value="'+i+'">'+i+" год"+'</option>');
                                                                      }
                                                                      else if(i==2||i==3||i==4){
                                                                         document.write('<option value="'+i+'">'+i+" года"+'</option>');
                                                                      }
                                                                      else{
                                                                        document.write('<option value="'+i+'">'+i+" лет"+'</option>');
                                                                      }
                                                                  }
                                                              </script>
                  
                                                          </select>
                                                        </div>
                                                    </div>
                                                  
                                                    <div class="form-group">
                                                        <div class="col-lg-offset-2 col-lg-10">
                                                            <button type="submit" class="btn btn-sm btn-default">Sign in</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="vars" class="tab-pane fade">Переменные</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('modal')
    <!-- HTML-код модального окна -->
    <div id="modal" class="modal fade">
        <div class="modal-dialog modal-lg modalInsideEmployee">
            <div class="modal-content">
                <div class="modal-header" style="text-align: center;">
                    <h4 class="modal-title" style="display: inline-block;">Информация о товаре</h4>
                    <button id="" type="button" class="close" data-dismiss="modal" aria-hidden="true">×
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12 padding-10">
                        {{ csrf_field() }}
                        <label for="product_name" class="col-md-4 control-label">Наименование</label>
                        <input id="product_id" type="hidden" class="form-control" name="product_id">
                        <div class="col-md-6">
                            <input id="product_name" type="text" class="form-control" name="product_name" value="{{ old('product_name') }}" required autofocus>
                        </div>
                    </div>
                    <div class="col-md-12 padding-10">
                        <label for="product_quantity" class="col-md-4 control-label">Количество</label>
                        <div class="col-md-6">
                            <input id="product_quantity" type="text" class="form-control" name="product_quantity" value="{{ old('product_quantity') }}" required>
                        </div>
                    </div>
                    <div class="col-md-12 padding-10">
                        <label for="product_price" class="col-md-4 control-label">Цена</label>
                        <div class="col-md-6">
                            <input id="product_price" type="text" class="form-control" name="product_price" value="{{ old('product_price') }}" required>
                        </div>
                    </div>
                    <div class="col-md-4 col-md-offset-8 btn-submit-counterpart">
                        <button id="" type="submit" form="" class="btn btn-danger" onclick="setProducts();">
                            Сохранить
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

