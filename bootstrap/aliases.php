<?php

use SideKit\Config\ConfigKit;
/*
 * --------------------------------------------------------------------------
 * Register custom Yii aliases
 * --------------------------------------------------------------------------
 *
 * As we have changed the structure. Modify default Yii aliases here.
 */
Yii::setAlias('@domainName', (YII_ENV === 'dev') ? '/casa_bravo/public' : 'https://www.casa-bravo.mx');
Yii::setAlias('@admin', ConfigKit::config()->getBasePath() . DIRECTORY_SEPARATOR . '../admin');
Yii::setAlias('@web', ConfigKit::config()->getBasePath() . DIRECTORY_SEPARATOR . '../public');
//Yii::setAlias('@domainName', (YII_ENV === 'dev') ? '/casa_bravo/public' : 'https://www.website.casa-bravo.mx');

//Yii::setAlias('@website', ConfigKit::config()->getBasePath() . DIRECTORY_SEPARATOR . '../public');