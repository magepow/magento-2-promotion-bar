## Magento 2 Promotion Bar

Magento 2 Promotiobar is a module allows admin to show their promotion banner at some positions of the pages to attract customers about promotions.

### Benefits

- Create promotionbar according to image, text,...

- Show promotionbar on 3 positions: menutop, top content, bottom page

- Show promotionbar on cms pages, product pages, category pages

- Save time for the project

- Apply precedence rule to promotionbar

- Manage promotionbar rules in the backend

- Works well on mobile devices

## Download Magento 2 Promotionbar Extension
### Install via composer (recommend)
Run the following commands in Magento 2 root folder:
```
composer require magepow/promotionbar
php bin/magento setup:upgrade
php bin/magento setup:static-content:deploy -f

```

## Step 2: How to use Magento 2 Promotionbar?

  ### 1. General configuration

  Login to magento admin, choose `stores->configuration->magepow->Promotion bar`
  
  ![Image of magento admin config](https://github.com/magepow/magento-2-promotion-bar/blob/master/media/config_general.png)

  * Module enable: Select `yes` to enable module
  * Show slider: Select `yes` to enable slider
  * Show Slider Control: Select `yes` to enable previous/next control
  * Auto speed slider (seconds): Transit time for slider.
  
  
  ### 2. Details Configuration
   #### 2.1 Add, Edit Prmotionbar
   Choose `Magepow->Promotionbar Management->Add New Promotionbar Rule`.
   
   ##### 2.1.1 General Information
   ![Image of magento backend](https://github.com/magepow/magento-2-promotion-bar/blob/master/media/promotionbar_general_1.png)
   ![Image of magento backend](https://github.com/magepow/magento-2-promotion-bar/blob/master/media/promotionbar_general_2.png)
   ![Image of magento backend](https://github.com/magepow/magento-2-promotion-bar/blob/master/media/promotionbar_general_3.png)
   
   * Name: Name of your promotionbar management rule
   * Store View : Define which store view you wish to show
   * Customer Group : Define which customer group you wish to show
   * Sort order : This part is used for the priority. If there is any rule have the same information. then the one which lower number will have the higher priority.
   * Status: Select Enable/Disable for turning on/off the size chart rule.
   * Start at: Show promotionbar at time
   * End at : Turn off promotionbar at time.
   ##### 2.1.2 Rule Information
   ![Image of magento backend](https://github.com/magepow/magento-2-promotion-bar/blob/master/media/promotionbar_rule_1.png)
   ![Image of magento backend](https://github.com/magepow/magento-2-promotion-bar/blob/master/media/promotionbar_rule_2.png)
   ![Image of magento backend](https://github.com/magepow/magento-2-promotion-bar/blob/master/media/promotionbar_rule_3.png)
   * Position: Select postion for the promotionbar 
   * Select Page: Select home page, checkout page, cart page
   * Category Page(s): Select category page to show promotionbar
   * Show on product page: Select yes/no to turn on/ turn off the product page and add rule for product if you turn on show on product page mode.
   
     ##### 2.1.3 Design Information
      ![Image of magento backend](https://github.com/magepow/magento-2-promotion-bar/blob/master/media/promotionbar_design.png).
   
   #### 2.2 Delete Promotionbar
   ![Image of magento backend](https://github.com/magepow/magento-2-promotion-bar/blob/master/media/promotionbar_delete.png)
    
   Run the following command  
   
   ```
   php bin/magento cache:clean
   ```
   Or go to `admin -> tools -> cache management` and click on flush magento cache to get the result
   
  #### 2.3. Result
   
   ![Image of magento store front](https://github.com/magepow/magento-2-promotion-bar/blob/master/media/result.png)
   
 ## Donation

If this project help you reduce time to develop, you can give me a cup of coffee :) 

[![paypal](https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif)](https://www.paypal.com/paypalme/alopay)

      
**[Our Magento 2 Extensions](https://magepow.com/magento-2-extensions.html)**

* [Magento 2 Recent Sales Notification](https://magepow.com/magento-2-recent-sales-notification.html)

* [Magento Categories Extension](https://magepow.com/magento-categories-extension.html)

* [Magento Sticky Cart](https://magepow.com/magento-sticky-cart.html)

* [Magento Ajax Contact](https://magepow.com/magento-ajax-contact-form.html)

* [Magento Lazy Load](https://magepow.com/magento-lazy-load.html)

* [Magento 2 Mutil Translate](https://magepow.com/magento-multi-translate.html)

* [Magento 2 Instagram Integration](https://magepow.com/magento-2-instagram.html)

* [Lookbook Pin Products](https://magepow.com/lookbook-pin-products.html)

* [Magento Product Slider](https://magepow.com/magento-product-slider.html)

* [Magento Product Banner](https://magepow.com/magento-banner-slider.html)

**[Our Magento services](https://magepow.com/magento-services.html)**

* [PSD to Magento 2 Theme Conversion](https://magepow.com/psd-to-magento-theme-conversion.html)

* [Magento Speed Optimization Service](https://magepow.com/magento-speed-optimization-service.html)

* [Magento Security Patch Installation](https://magepow.com/magento-security-patch-installation.html)

* [Magento Website Maintenance Service](https://magepow.com/website-maintenance-service.html)

* [Magento Professional Installation Service](https://magepow.com/professional-installation-service.html)

* [Magento Upgrade Service](https://magepow.com/magento-upgrade-service.html)

* [Customization Service](https://magepow.com/customization-service.html)

* [Hire Magento Developer](https://magepow.com/hire-magento-developer.html)

**[Our Magento Themes](https://alothemes.com/)**

* [Expert Multipurpose Responsive Magento 2 Theme](https://1.envato.market/c/1314680/275988/4415?u=https://themeforest.net/item/expert-premium-responsive-magento-2-and-1-support-rtl-magento-2-/21667789)

* [Gecko Premium Responsive Magento 2 Theme](https://1.envato.market/c/1314680/275988/4415?u=https://themeforest.net/item/gecko-responsive-magento-2-theme-rtl-supported/24677410)

* [Milano Fashion Responsive Magento 2 Theme](https://1.envato.market/c/1314680/275988/4415?u=https://themeforest.net/item/milano-fashion-responsive-magento-1-2-theme/12141971)

* [Electro 2 Responsive Magento 2 Theme](https://1.envato.market/c/1314680/275988/4415?u=https://themeforest.net/item/electro2-premium-responsive-magento-2-rtl-supported/26875864)

* [Electro Responsive Magento 2 Theme](https://1.envato.market/c/1314680/275988/4415?u=https://themeforest.net/item/electro-responsive-magento-1-2-theme/17042067)

* [Pizzaro Food responsive Magento 2 Theme](https://1.envato.market/c/1314680/275988/4415?u=https://themeforest.net/item/pizzaro-food-responsive-magento-1-2-theme/19438157)

* [Biolife organic responsive Magento 2 Theme](https://1.envato.market/c/1314680/275988/4415?u=https://themeforest.net/item/biolife-organic-food-magento-2-theme-rtl-supported/25712510)

* [Market responsive Magento 2 Theme](https://1.envato.market/c/1314680/275988/4415?u=https://themeforest.net/item/market-responsive-magento-2-theme/22997928)

* [Kuteshop responsive Magento 2 Theme](https://1.envato.market/c/1314680/275988/4415?u=https://themeforest.net/item/kuteshop-multipurpose-responsive-magento-1-2-theme/12985435)

* [Bencher - Responsive Magento 2 Theme](https://1.envato.market/c/1314680/275988/4415?u=https://themeforest.net/item/bencher-responsive-magento-1-2-theme/15787772)

* [Supermarket Responsive Magento 2 Theme](https://1.envato.market/c/1314680/275988/4415?u=https://themeforest.net/item/supermarket-responsive-magento-1-2-theme/18447995)
