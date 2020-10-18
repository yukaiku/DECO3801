using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.UI;
using UnityEngine.EventSystems;
using DG.Tweening;


public class NounLinkage : MonoBehaviour
{
    [Tooltip("The corresponding Noun Tag.")]
    public GameObject nounTag;
    private Text nounText;
    [Tooltip("Assign with IsResult Component")]
    public IsResult resultTrigger;
    [Tooltip("Assign with TimerUtility Component")]
    public TimerUtility timer;
    public int timeBonus;

    private void isArgsNull()
    {
        nounText = nounTag.GetComponent<Text>();
        if (nounText == null || resultTrigger == null || timer == null)
        {
            NounLinkage component = this.gameObject.GetComponent<NounLinkage>();
            Destroy(component);

            Debug.Log(string.Format("Null arguments : the component won't work"));
        }
    }

    public void setGlobalNounObject()
    {
        DataStorage.setSelectedNounTag(nounText.text);
    }

    private void clickNounObject()
    {
        if (nounTag.activeSelf)
        {
            // disable the noun tag/text
            nounTag.SetActive(false);
            Debug.Log(string.Format("Disable noun '{0}' text '{1}' successful",
                this.gameObject.name, nounText.text));

            // save the name of a clicked noun object
            string nounName = gameObject.GetComponent<Text>().text;
            if (nounName != null && nounName != "")
                DataSystem.saveNounsClicked(nounName);

            // increase player score
            DataSystem.scoreUp(DataStorage.getScorePerNoun());

            // time bonus
            timer.timeUp(timeBonus);

            objectAnimation(gameObject);

            // inactive the noun object
            // this.gameObject.SetActive(false);

            // destroy self
            
        }
    }

    private void objectAnimation(GameObject gameoObject){
        gameObject.transform.DOScale(new Vector3(1.2f, 1.2f, 1.2f), 0.5f).OnComplete(() => 
        {
            gameObject.GetComponent<SpriteRenderer>().DOFade(0, 0.5f).OnComplete(() => {
                   Destroy(gameObject);
            });
        });
    }

    /* ********************************************************************************* *
     * ****************************** CUSTOM STUFFS ABOVE ****************************** *
     * ********************************************************************************* */

    private void OnMouseDown()
    {
        // check if the mouse was clicked over a UI element
        if (EventSystem.current.IsPointerOverGameObject())
            return;

        if (global.isPause == false){
            clickNounObject();
            resultTrigger.isAllNounClicked();
        }
        
    }

    // Start is called before the first frame update
    void Start()
    {
        isArgsNull();
    }

    // Update is called once per frame
    void Update()
    {

    }
}
