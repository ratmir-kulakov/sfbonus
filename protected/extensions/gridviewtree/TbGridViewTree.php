<?php

Yii::import('bootstrap.widgets.TbGridView');

class TbGridViewTree extends TbGridView 
{
    public function init()
    {
        parent::init();
        $assetsUrl = Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias('ext.gridviewtree.assets'));
        Yii::app()->getClientScript()->registerCssFile($assetsUrl.'/treetable/jquery.treeTable.css');
        Yii::app()->getClientScript()->registerScriptFile($assetsUrl.'/treetable/jquery.treeTable.js', CClientScript::POS_END);
    }


    public function renderTableRow($row)
	{
		$nodeId = $this->dataProvider->data[$row]->id;
		$nodeRoot = $this->dataProvider->data[$row]->root;
//		$parentId = $this->dataProvider->data[$row]->parent_id;

		if($this->rowCssClassExpression!==null)
		{
			$data=$this->dataProvider->data[$row];
			$class=$this->evaluateExpression($this->rowCssClassExpression,array('row'=>$row,'data'=>$data));
		}
		else if(is_array($this->rowCssClass) && ($n=count($this->rowCssClass))>0)
			$class=$this->rowCssClass[$row%$n];
		else
			$class='';
		
		$nodeIdId = 'node-' . $nodeId;
		if ($nodeId !== $nodeRoot)
			$class .= ' child-of-node-' . $nodeRoot;

		echo '<tr id="'.$nodeIdId.'" class="'.$class.'">';
		foreach($this->columns as $column)
			$column->renderDataCell($row);
		echo "</tr>\n";
	}

}
