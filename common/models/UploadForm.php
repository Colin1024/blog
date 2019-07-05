<?phpnamespace common\models;use yii\base\Model;use yii\web\UploadedFile;use Yii;class UploadForm extends Model{    /**     * @var UploadedFile     */    public $imageFile;    public $csvFile;    public $head_imgFile;    public function rules()    {        return [            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, gif','mimeTypes'=>'image/jpg,image/jpeg,image/png,image/gif'],            [['csvFile'], 'file', 'skipOnEmpty' => true],            [['head_imgFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, gif','mimeTypes'=>'image/jpeg,image/jpg,image/png,image/gif'],        ];    }    /**     * @param string $type     * @return array     */    public function upload($type='image')    {        if ($this->validate()) {            $path = 'uploads/'.$type.'/'.date('Ymd');//            $rootPath = Yii::getAlias('@root') . $path;            $rootPath = $path;            if(!is_dir($rootPath)){                mkdir($rootPath,0777,true);            }            $file = $type.'File';            $fileName = uniqid().'.' .$this->$file->extension;            $filePath = $rootPath.'/'.$fileName;            $this->$file->saveAs($filePath);            return ['status' => 200, 'path' => '/' . $path .'/'. $fileName]; // uploads目录前加'/',否则url美化后无法正常显示        }else{            $error = array_values($this->getFirstErrors())[0];            return ['status' => 100, 'msg' => $error];        }    }}