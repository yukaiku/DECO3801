using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.UI;

public class SoundControl : MonoBehaviour
{
    public AudioSource BGSound;
    public AudioSource audioSound;
    
    public AudioClip audioClip;

    public Slider MainSlider;
    // Start is called before the first frame update
    public void BGcontrolSound(){
        BGSound.volume = MainSlider.value;
    }

    public void EFcontrolSound(){   
        audioSound.volume = MainSlider.value;
    }   

    void Start()
    {
        audioSound = gameObject.AddComponent<AudioSource>();
        audioSound.clip = audioClip;
        
    }

    // Update is called once per frame
    void Update()
    {
        if(Input.GetMouseButtonDown(0))
        { 
            Debug.Log(audioSound.gameObject.name);
            audioSound.Play();          
        }
    }
}
    
