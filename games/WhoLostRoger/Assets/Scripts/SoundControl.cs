using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.UI;

public class SoundControl : MonoBehaviour
{
    public AudioSource BGSound;
    public AudioSource audioSound;
    
    public Slider MainSlider;
    // Start is called before the first frame update

    //control the bgm volumn by slider
    public void BGcontrolSound(){
        BGSound.volume = MainSlider.value;
    }
    //control the effect volumn by slider
    public void EFcontrolSound(){   
        audioSound.volume = MainSlider.value;
    }   

    void Start()
    {
        
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
    
