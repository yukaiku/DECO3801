using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.UI;
using UnityEngine.SceneManagement;

/*
 * This component script is used for controlling BGM and Effect sound  
 * by slider.
 * 
 * In Unity inspector,
 * @require AudioSource           BGSound   
 * @require AudioSource           EFSound
 * @require Slider                MainBGSlider
 * @require Slider                MainEFSlider
 * @require Slider                MenuBGSlider
 * @require Slider                MenuEFSlider
 */
public class SoundControl : MonoBehaviour
{
    public AudioSource BGSound;
    public AudioSource EFSound;
    
    public Slider MainBGSlider;
    public Slider MainEFSlider;

    public Slider MenuBGSlider;
    public Slider MenuEFSlider;
    // Start is called before the first frame update

    //control the bgm volumn by slider in game
    public void BGcontrolSound(){
        BGSound.volume = MainBGSlider.value;
        global.bgVolumn = MainBGSlider.value;
    }
    //control the effect volumn by slider in game
    public void EFcontrolSound(){   
        EFSound.volume = MainEFSlider.value;
        global.soundVolumn = MainEFSlider.value;
    }
    //control the bgm volumn by slider in main menu
    public void MainmenuBGcontrolSound(){
        global.bgVolumn = MenuBGSlider.value;
        Debug.Log(global.bgVolumn);
    }
    //control the effect volumn by slider in main menu
    public void MainmenuEFcontrolSound(){
       global.soundVolumn = MenuEFSlider.value;
       Debug.Log(global.soundVolumn);
    }

    void Start()
    {  
        Scene scene = SceneManager.GetActiveScene ();
        if(scene.name == global.nowSceneName)
        {
            BGSound.volume = global.bgVolumn;            // tranfer global BG and EF sound to game
            EFSound.volume = global.soundVolumn;
            MainBGSlider.value = global.bgVolumn;
            MainEFSlider.value = global.soundVolumn;

        }else if(scene.name == "LoadingScene"){
            MenuBGSlider.value = global.bgVolumn;       // tranfer game BG and EF sound to global
            MenuEFSlider.value = global.soundVolumn;
        }
    }

    // Update is called once per frame
    void Update()
    {
        
        // if(Input.GetMouseButtonDown(0))
        // { 
        //     Debug.Log(audioSound.gameObject.name);
        //     audioSound.Play();          
        // }
    }
}
    
