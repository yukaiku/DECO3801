using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.UI;

public class ActivateHintScript : MonoBehaviour
{
    private string[] hintString = new string[]{
        "Carafe – Used to hold beverages",
        "Cloud – Droplets formed in the sky",
        "Framed Art – Somewhere in drawers",
        "Futon – A type of soft, flexible mattress",
        "Marigold – A type of plant",
        "Memoir – It has words in it",
        "Spume – Usually found in water",
        "Swan – A bird",
        "Valise – Travellers carry it"
        };
    private string hintStringOne;
    private Text hintText;
    //public string Text hintText;
    
    // Start is called before the first frame update
    void Start()
    {
//        hintText=GetComponent<Text>();
    }

    public void clickHint(Text hintText) {
        int hintIndex = Random.Range(0, hintString.Length);
        hintStringOne= hintString[hintIndex];
        hintText.text = hintStringOne;
    }

    // Update is called once per frame
    void Update()
    {
        
    }
}
