using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.UI;

public class SoundControl : MonoBehaviour
{
    public AudioSource audioSound;
    public Slider MainSlider;
    // Start is called before the first frame update
    public void controlSound(){
        audioSound.volume = MainSlider.value;
    }    
    void Start()
    {
        
    }

    // Update is called once per frame
    void Update()
    {
        
    }
}
