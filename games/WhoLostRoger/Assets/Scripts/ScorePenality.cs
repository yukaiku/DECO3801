using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.EventSystems;

// provide score penality when wrong clicking
public class ScorePenality : MonoBehaviour
{
    private GameObject[] nounObjectList;

    private void getNounObjectList()
    {
        List<GameObject> nounObjects = new List<GameObject>();
        foreach (NounLinkage nounObject in Object.FindObjectsOfType<NounLinkage>())
        {
            GameObject noun = nounObject.gameObject;
            if (noun != null)
            {
                nounObjects.Add(noun);
            }
        }
        nounObjectList = nounObjects.ToArray();

        Debug.Log(string.Format("In total '{0}' noun objects in this level'", nounObjectList.Length));
    }

    private void setScorePenality()
    {
        foreach (GameObject nounObject in nounObjectList)
        {
            nounObject.AddComponent<ScorePenality>();
        }
    }

    /* ********************************************************************************* *
     * ****************************** CUSTOM STUFFS ABOVE ****************************** *
     * ********************************************************************************* */

    private void OnMouseDown()
    {
        if (EventSystem.current.IsPointerOverGameObject())
            return;

        DataSystem.scoreDown(1);
        if (this.gameObject.GetComponent<NounLinkage>() != null)
        {
            DataSystem.scoreUp(1);
        }
    }

    // Start is called before the first frame update
    void Start()
    {
        if (this.gameObject.GetComponent<NounLinkage>() == null)
        {
            getNounObjectList();
            setScorePenality();
        }
    }

    // Update is called once per frame
    void Update()
    {
        
    }
}
